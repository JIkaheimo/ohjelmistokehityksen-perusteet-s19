<?php 

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if (isset($_GET['tr']) && $_GET['tr'] = true) haeHarjoitusTr();
    elseif (isset($_GET['id'])) haeHarjoitus();
    elseif (isset($_GET['ohjelma'])) haeOhjelmanHarjoitukset();
    else haeHarjoitukset();
    exit;
  case 'POST':
    lisaaHarjoitus();
    exit;
  case 'PUT':
    paivitaHarjoitus();
    exit;
  case 'DELETE':
    poistaHarjoitus();
    exit;
  default:
    http_response_code(Status::INVALID);
    lahetaViesti('Palvelin ei tunnistanut pyyntöä.');
}


// HAE_HARJOITUS =========================================================
function haeHarjoitus()
/**
 * Hakee tietokannassa olevan ykssttäisen harjoituksen
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

  // Harjoituksen pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  // (Tänne ei pitäisi ikinä joutua.)
  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    latehaViesti('Pyynnössä tulee olla id.');
    exit;
  }

  // Haetaan harjoitus joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $id = isset($_GET['id']) ? $_GET['id'] : $body->id;

  $harjoitus = Harjoitukset::hae($db, $id);

  if (!isset($harjoitus->ohjelmaId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoitusta ei löydetty.');
  }
  else
  {
    echo(json_encode($harjoitus));
  }

} // HAE_HARJOITUS_END


// HAE_HARJOITUS_TR =======================================================
function haeHarjoitusTr()
/**
 * Hakee tietokannassa olevan ykssittäisen harjoituksen
 * tr-elementin
 * 
 * TARVITTAVA DATA:
 * - id
 */
{
  header('Content-Type: text/plain; charset=UTF-8');
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Methods: GET');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  $harjoitusId = tarkistaId($_GET, 'harjoitusId');

  $harjoitus = Harjoitukset::hae($db, $harjoitusId);

  if (!isset($harjoitus->ohjelmaId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoitusta ei löydetty.');
  }
  else
  {
    require_once(__DIR__.'/../Komponentit/Harjoitukset/harjoitus_tr_content.php');
    echo(HarjoitusTRContent($harjoitus));
  }

} // HAE_HARJOITUS_TR_END


// HAE_HARJOITUKSET ========================================================
function haeHarjoitukset()
/**
 * Hakee tietokannassa olevat harjoitukset ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  $harjoitukset = Harjoitukset::hae($db);
  
  if (empty($harjoitukset))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoituksia ei löydetty.');
  }
  else
  {
    echo(json_encode(array('harjoitukset' => $harjoitukset)));
  }
} // HAE_HARJOITUKSET_END


// HAE_OHJELMAN_HARJOITUKSET ===============================================
function haeOhjelmanHarjoitukset() 
/**
 * Hakee tietokannassa olevat ohjelman harjoitukset ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');
  
  global $db;

  // Harjoitukset pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  // (Tänne ei pitäisi ikinä joutua.)
  if (!isset($body->ohjelma) && !isset($_GET['ohjelma']))
  {
    http_response_code(Status::INVALID);
    latehaViesti('Pyynnössä tulee olla ohjelma.');
    exit;
  }

  // Haetaan harjoitus joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $ohjelma = isset($_GET['ohjelma']) ? $_GET['ohjelma'] : $body->ohjelma;

  $harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelma);

  if (!empty($harjoitukset)) 
  {
    echo(json_encode(array('harjoitukset' => $harjoitukset)));
  } 
  else 
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoituksia ei löydetty.');   
  }
} // HAE_OHJELMAN_HARJOITUKSET_END 


// LISAA_HARJOITUS ========================================================
function lisaaHarjoitus() 
/**
 * Hoitaa JSON-formaatissa olevan harjoituksen lisäyksen tietokantaan.
 * Lähettää käyttäjälle luodun harjoituksen takaisin.
 * 
 * TARVITTAVA DATA:
 * - nimi
 * - ohjelmaId
 */
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    !tarkistaData($body, 'nimi') ||
    !tarkistaData($body, 'ohjelmaId')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Harjoitusta ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  // Tarkistetaan että ohjelma on olemassa ja sen luonut käyttäjä lisää ohjelman.
  $ohjelma = Ohjelmat::hae($db, $body->ohjelmaId);
  if (!isset($ohjelma->kayttajatunnus))
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Harjoitusta ei pystytä lisäämään olemassaolemattomaan ohjelmaan.');
  }

  tarkistaOikeus($ohjelma->kayttajatunnus);

  // Yritetään lisätä harjoitus tietokantaan.
  $id = Harjoitukset::lisaa(
    $db,
    puhdistaTagit($body->nimi),
    puhdistaTagit($body->ohjelmaId)
  );
  
  // Palautetaan luotu harjoitus jos sen luominen onnistui.
  if ($id)
  {
    $harjoitus = Harjoitukset::hae($db, $id);
    http_response_code(Status::CREATED);
    echo(json_encode($harjoitus));
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // LISAA_HARJOITUS_END


// PAIVITA_HARJOITUS =====================================================
function paivitaHarjoitus() 
/**
 * Hoitaa JSON-formaatissa olevann harjoituksen tietojen päivityksen tietokantaan.
 * 
 * !HOX! Jos annetaan pelkkä harjoituksen id, data ei muutu tietokannassa ollenkaan...
 * 
 * TARVITTAVA DATA:
 * - id / harjoitusId päivitettävän harjoituksen id
 * 
 * VAIHTOEHTOINEN DATA:
 * - nimi
 * - ohjelmaId
 */
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  // Haetaan päivitettävä harjoitus
  $harjoitusId = tarkistaId($body, 'harjoitusId');
  $harjoitus = Harjoitukset::hae($db, $harjoitusId);

  if (!isset($harjoitus->ohjelmaId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Päivitettävää harjoitusta ei pystytty löytämään...');
    exit;
  }

  // Sallitaan vain harjoituksen ohjelman luoneen käyttäjän päivittää harjoitus...
  $kayttaja = Harjoitukset::haeKayttaja($db, $harjoitusId);
  tarkistaOikeus($kayttaja->kayttajatunnus);

  // Tarkistetaan päivitettävä data.
  $harjoitus->nimi = tarkistaData($body, 'nimi', $harjoitus->nimi);
  $harjoitus->ohjelmaId = tarkistaData($body, 'ohjelmaId', $harjoitus->ohjelmaId);

  // Suoritetaan päivitys
  $onnistuiko = Harjoitukset::paivita(
    $db,
    puhdistaTagit($harjoitus->harjoitusId),
    puhdistaTagit($harjoitus->nimi),
    puhdistaTagit($harjoitus->ohjelmaId)
  );

  // Tarkistetaan vielä että päivitys onnistui.

  if ($onnistuiko)
  {
    http_response_code(Status::UPDATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // PAIVITA_HARJOITUS_END


// POISTA_HARJOITUS ======================================================
function poistaHarjoitus() 
/**
 * Hoitaa harjoituksen poiston tietokannasta annetun idn:n perusteella.
 * 
 * TARVITTAVA DATA:
 * - id / harjoitusId
 */
{
  header('Access-Control-Allow-Methods: DELETE');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  $harjoitusId = tarkistaId($body, 'harjoitusId');

  global $db;

  $harjoitus = Harjoitukset::hae($db, $harjoitusId);

  if (!isset($harjoitus->ohjelmaId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Poistettavaa harjoitusta ei pystytty löytämään...');
    exit;
  }

  // Suoritetaan ja tarkistetaan harjoituksen poisto.
  if (Harjoitukset::poista($db, $harjoitusId))
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // POISTA_HARJOITUS_END 

?>