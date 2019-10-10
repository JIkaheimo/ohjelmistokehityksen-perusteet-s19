<?php 

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");

// Mahdollistaa kuvien lisäämisen.
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
  case 'PUT':
    paivitaKayttajaJSON();
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
{
  header('Access-Control-Allow-Methods: PUT')
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  global $db;

  if (isset($_FILES['kuva']) && $_FILES['kuva']['size'] > 0)
  {
    $tiedostoNimi = $_POST['kayttajatunnus'];
    $tallennuskohde = __DIR__.'/../Assets/Kayttajat/';
    $reitti = $tallennuskohde . basename($_FILES['kuva']['name']);
    $kuvatyyppi = strtolower(pathinfo($reitti, PATHINFO_EXTENSION));
    $tiedostoNimi .= '.';
    $tiedostoNimi .= $kuvatyyppi;
    $sallitutTyypit = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($kuvatyyppi, $sallitutTyypit)){
      move_uploaded_file($_FILES['kuva']['tmp_name'], $tallennuskohde.$tiedostoNimi);
    }
  }

  $_POST['etunimi'] = isset($_POST['etunimi']) ? $_POST['etunimi'] : null;
  $_POST['sukunimi'] = isset($_POST['sukunimi']) ? $_POST['sukunimi'] : null;
  $_POST['kuvaus'] = isset($_POST['kuvaus']) ? $_POST['kuvaus'] : null;
  $tiedostoNimi = isset($tiedostoNimi) ? $tiedostoNimi : 'kayttaja-placeholder.png';


  $onnistuiko = Kayttajat::paivita(
    $db,
    $_POST['kayttajatunnus'],
    $_POST['etunimi'],
    $_POST['sukunimi'],
    $tiedostoNimi,
    $_POST['kuvaus']
  );

  if ($onnistuiko)
  {
    header('Location: ./../profiili.php');
  }
} // PAIVITA_KAYTTAJA_END


// PAIVITA_KAYTTAJA_JSON ========================================================
function paivitaKayttajaJSON()
/**
 * Päivittää käyttäjän tiedot tietokantaan.
 */
{
  header('Access-Control-Allow-Methods: PUT')
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  $etunimi = isset($body->etunimi) ? poistaTagit($body->etunimi) : null;
  $kuva = isset($body->kuva) ? poistaTagit($body->kuva) : null;
  $sukunimi = isset($body->sukunimi) ? poistaTagit($body->sukunimi) : null;
  $kuvaus = isset($body->kuvaus) ? poistaTagit($body->kuvaus) : null;

  
  $onnistuiko = Kayttajat::paivita(
    $db,
    $body->kayttajatunnus, 
    $etunimi, 
    $sukunimi, 
    $kuva,
    $kuvaus
  );

  if ($onnistuiko) {
    http_response_code(200);
    lahetaViesti('Käyttäjän päivitys onnistui!');
  } else {
    http_response_code(503);
    lahetaViesti('Käyttäjän päivitys epäonnistui...');
  }
} // PAIVITA_KAYTTAJA_JSON_END



?>


