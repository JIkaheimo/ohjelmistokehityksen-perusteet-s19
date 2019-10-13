<?php 

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");

$palautaJSON = !isset($_POST['kayttajatunnus']);
if ($palautaJSON)
{
  header('Content-Type: application/json; charset=UTF-8');
}

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    haeKayttajat();
    break;
  case 'POST':
    paivitaKayttaja();
    break;
  default:
    http_response_code(403);
}


// HAE_KAYTTAJAT ===============================================================
function haeKayttajat() 
/**
 * Palauttaa kaikki käyttäjät tietokannasta.
 */
{
  header('Access-Control-Allow-Methods: GET');
  
  global $db;
  $kayttajat = Kayttajat::hae($db);

  if (count($kayttajat) > 0) 
  {
    http_response_code(200);
    echo(json_encode(array('kayttajat' => $kayttajat)));
  } 
  else 
  {
    http_response_code(404);
    lahetaViesti('Käyttäjiä ei löydetty.');   
  }
  exit;
} // HAE_KAYTTAJAT_END


// PAIVITA_KAYTTAJA ============================================================
function paivitaKayttaja()
/**
 * Hoitaa POST-parametreina olevan ohjelman tietojen päivityksen tietokantaan,
 * ( Mahdollistaa kuvien lisäyksen )
 * 
 * !HOX! Jos annetaan pelkkä käyttäjätunnus, data ei muutu tietokannassa ollenkaan...
 * 
 * TARVITTAVA DATA:
 * - kayttajatunnus päivitettävän käyttäjän tunnus
 * 
 * VAIHTOEHTOINEN DATA:
 * - etunimi
 * - sukunimi
 * - kuvaus
 * - kuva
 */
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  global $db;

  // Tarkistetaan että käyttäjätunnus on annettu ja se on olemassa.
  $kayttajatunnus = tarkistaId($_POST, 'kayttajatunnus');
  $kayttaja = Kayttajat::kayttaja($db, $kayttajatunnus);

  if (!isset($kayttaja->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Päivitettävää käyttäjää ei pystytty löytämään...');
    exit;
  }

  // Sallitaan vain käyttäjän itse päivittää omia tietojaan.
  tarkistaOikeus($kayttaja->kayttajatunnus);

  // Tarkistetaan päivitettävä data.
  $kayttaja->etunimi = tarkistaData($_POST, 'etunimi', $kayttaja->etunimi);
  $kayttaja->sukunimi = tarkistaData($_POST, 'sukunimi', $kayttaja->sukunimi);
  $kayttaja->kuvaus = tarkistaData($_POST, 'kuvaus', $kayttaja->kuvaus);

  // Tallennetaan käyttäjän kuva.
  if (tarkistaData($_FILES['kuva'], 'name'))
  {  
    $polku = __DIR__.'/../Assets/Kayttajat/';
    $kayttaja->kuva = tallennaKuva($_FILES['kuva'], $kayttaja->kayttajatunnus, $polku);
  }


  // Suoritetaan päivitys.
  $onnistuiko = Kayttajat::paivita(
    $db,
    puhdistaTagit($kayttaja->kayttajatunnus),
    puhdistaTagit($kayttaja->etunimi),
    puhdistaTagit($kayttaja->sukunimi),
    puhdistaTagit($kayttaja->kuva),
    puhdistaTagit($kayttaja->kuvaus)
  );

  // Tarkistetaan voelä että päivitys onnistui.
  if ($onnistuiko)
  {
    //http_response_code(Status::UPDATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // PAIVITA_KAYTTAJA_END


?>


