<?php

require_once(__DIR__.'/queries.php');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if (isset($_GET['id'])) haeVaihe();
    else haeVaiheet();
    exit;
  case 'PUT':
    paivitaVaihe();
    exit;
  case 'POST':
    lisaaVaihe();
    exit;
  case 'DELETE':
    poistaVaihe();
    exit;
  default:
    http_response_code(Statis::INVALID);
    lahetaViesti('Palvelin ei tunnistanut pyyntöä.');
}


// HAE_VAIHE ==================================================
function haeVaihe()
/**
 * Hakee tietokannassa olevan yksittäusen vaiheen
 * ja lähettää sen JSON-formaatissa.
 * 
 * TARVITTAVA DATA:
 * - id
 */
{
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Methods: GET');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  // Vaiheen pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Pyynnösssä tulee olla id.');
    exit;
  }

  // Haetaan ohjelma joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $id = isset($_GET['id']) ? $_GET['id'] : $body->id;

  $vaihe = Vaiheet::hae($db, $id);

  if (!isset($vaihe->ojelmaId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Vaihetta ei löydetty.');
  }
  else
  {
    echo(json_encode($ohjelma));
  }
} // HAE_VAIHE_END


// HAE_VAIHEET ===============================================
function haeVaiheet()
/**
 * Hakee tietokannassa olevat vaiheet ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  $vaiheet = Vaiheet::hae($db);

  if (empty($vaiheet))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Vaiheitaa ei löydetty.');
  }
  else
  {
    echo(json_encode(array('vaiheet' => $vaiheet)));
  }
} // HAE_VAIHEET_END


// LISAA_VAIHE ================================================
function lisaaVaihe()
/**
 * Lisää vaiheen annetun JSON-muotoisen datan perusteella tietokantaan.
 * 
 * TARITTAVA DATA:
 * - nimi (string) vaiheennimi
 * - harjoitusId (int) harjoituksen id, mihin vaihe liitetään
 * 
 * VAIHTOEHTOINEN DATA:
 * - kuvaus (string) vaiheen kuvaus
 * - ohjelinkki (string) osoitelinkki harjoituksen ohjeeseen
 */
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  global $db;


  // Tarkistetaan että tarvittava data on annettu.
  if (
    !tarkistaData($body, 'harjoitusId') ||
    !tarkistaData($body, 'nimi')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Vaihetta ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  $ohjelinkki = tarkistaData($body, 'ohjelinkki', null);
  $kuvaus = tarkistaData($body, 'kuvaus', null);

  // Yritetään lisätä vaihe tietokantaan.
  $id = Vaiheet::uusi(
    $db,
    puhdistaTagit($body->harjoitusId),
    puhdistaTagit($body->nimi),
    puhdistaTagit($ohjelinkki),
    puhdistaTagit($kuvaus)
  );

  // Jos vaiheen lisääminen onnistuu, palautetaan luotu tietue.
  if ($id) 
  {
    $vaihe = Vaiheet::hae($db, $id);
    http_response_code(Status::CREATED);
    echo(json_encode($vaihe)); 
  } 
  else 
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // LISAA_VAIHE_END


// PAIVITA_VAIHE =================================================
function paivitaVaihe()
/**
 * Päivittää vaiheen annetun JSON-muotoisen datan perusteella tietokantaan.
 * 
 * TARITTAVA DATA:
 * - id / vaiheId (int) päivitettävän vaiheen id
 * 
 * VAIHTOEHTOINEN DATA:
 * - nimi (string) vaiheen uusi nimi
 * - kuvaus (string) vaiheen uusi kuvaus
 * - harjoitusId (int) harjoituksen id, mihin vaihe liitetään
 * - ohjelinkki (string) osoitelinkki harjoituksen ohjeeseen
 */
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  $vaiheId = tarkistaId($body, 'vaiheId');

  // Tarkistetaan onko vaihe olemassa.
  $vaihe = Vaiheet::hae($db, $vaiheId);
  if (!isset($vaihe->harjoitusId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Päivitettävää vaihetta ei pystytty löytämään...');
    exit;
  }

  // Pidetään huoli että päivitetään vain annettu data.
  $vaihe->nimi = tarkistaData($body, 'nimi', $vaihe->nimi);
  $vaihe->kuvaus = tarkistaData($body, 'kuvaus', $vaihe->kuvaus);
  $vaihe->harjoitusId = tarkistaData($body, 'harjoitusId', $vaihe->harjoitusId);
  $vaihe->ohjelinkki = tarkistaData($body, 'ohjelinkki', $vaihe->ohjelinkki);


  // Suoritetaan päivitys.
  $onnistuiko = Vaiheet::paivita(
    $db,
    puhdistaTagit($vaihe->vaiheId),
    puhdistaTagit($vaihe->harjoitusId),
    puhdistaTagit($vaihe->nimi),
    puhdistaTagit($vaihe->ohjelinkki),
    puhdistaTagit($vaihe->kuvaus)
  );

  // Testataan onnistuminen.
  if ($onnistuiko) 
  {
    http_response_code(Status::OK);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // PAIVITA_VAIHE_END


// POISTA_VAIHE ======================================================
function poistaVaihe()
/**
 * Päivittää vaiheen JSON-datassa annetun id:n perusteella.
 * 
 * TARITTAVA DATA:
 * - id / vaiheId (int) poistettavan vaiheen id
 */
{
  header('Access-Control-Allow-Methods: DELETE');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  $vaiheId = tarkistaId($body, 'vaiheId');

  global $db;

  // Tarkistetaan onko vaihe olemassa.
  $vaihe = Vaiheet::hae($db, $vaiheId);

  if (!isset($vaihe->harjoitusId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Poistettavaa vaihetta ei pystytty löytämään...');
    exit;
  }

  if (Vaiheet::poista($db, $vaiheId))
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // POISTA_VAIHE_END


?>