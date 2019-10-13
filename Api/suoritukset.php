<?php

require_once(__DIR__.'/queries.php');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if (isset($_GET['tr'])) haeSuoritusTr();
    elseif (isset($_GET['id'])) haeSuoritus();
    else haeSuoritukset();
    exit;
  case 'POST':
    lisaaSuoritus();
    exit;
  case 'PUT':
    paivitaSuoritus();
    exit;
  case 'DELETE':
    poistaSuoritus();
    exit;
  default:
    http_response_code(403);
}


// HAE_SUORITUS ===============================================================
function haeSuoritus()
/**
 * Hakee tietokannassa olevan yksittäisen suorituksen
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

  // Suorituksen pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Pyynnössä tulee olla id.');
    exit;
  }

  // Haetaan suoritus joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $id = isset($_GET['id']) ? $_GET['id'] : $body->id;
  
  $suoritus = Suoritukset::hae($db, $id);

  if (!isset($suoritus->suoritusId))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Suoritusta ei löydetty.');
  }
  else
  {
    echo(json_encode($suoritus));
  }

} // HAE_SUORITUS_END


// HAE_SUORITUKSET =============================================================
function haeSuoritukset()
/**
 * Hakee tietokannassa olevat suoritukset ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  $suoritukset = Suoritukset::hae($db);

  if (empty($suoritukset))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Suorituksia ei löydetty.');
  }
  else
  {
    echo(json_encode(array('suoritukset' => $suoritukset)));
  }

} // HAE_SUORITUKSET_END


// HAE_SUORITUS_TR ============================================================
function haeSuoritusTr()
{
  header('Content-Type: text/html; charset=UTF-8');

  global $db;

  require_once(__DIR__.'/../Komponentit/Suoritukset/suoritus_tr.php');
  $suoritusId = tarkistaId($_GET, 'suoritusId');
  $suoritus = Suoritukset::hae($db, $suoritusId);

  json_encode(array('suoritus' => SuoritusTR($suoritus)));
}


// LISAA_SUORITUS ===============================================================
function lisaaSuoritus() 
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  global $db;
  
  session_start();
  
  // Tarkistetaan onko tarvittava data pyynnön rungossa
  if (
    !tarkistaData($body, 'kayttajatunnus') ||
    !tarkistaData($body, 'paivays') ||
    !tarkistaData($body, 'harjoitusId') ||
    !tarkistaData($body, 'kesto')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Suoritustaa ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  tarkistaOikeus($body->kayttajatunnus);
  
  $id = Suoritukset::uusi(
    $db,
    puhdistaTagit($body->kayttajatunnus),
    puhdistaTagit($body->paivays),
    puhdistaTagit($body->kesto),
    puhdistaTagit($body->harjoitusId)
  );

  if ($id)
  {
    $suoritus = Suoritukset::hae($db, $id);
    http_response_code(Status::CREATED);
    echo(json_encode($suoritus));
  }
  else
  // Tämä käsittelee pyynnössä tapahtuneen errorin.
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  } 

} // LISAA_SUORITUS_END 


// PAIVITA_SUORITUS ========================================================================
function paivitaSuoritus()
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  $suoritusId = tarkistaId($body, 'suoritusId');
  $suoritus = Suoritukset::hae($db, $suoritusId);

  if (!isset($suoritus->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Päivitettävää suoritusta ei pystytty löytämään...');
    exit;
  }

  tarkistaOikeus($suoritus->kayttajatunnus);

  $suoritus->kayttajatunnus = tarkistaData($body, 'kayttajatunnus', $suoritus->kayttajatunnus);
  $suoritus->paivays = tarkistaData($body, 'paivays', $suoritus->paivays);
  $suoritus->kesto = tarkistaData($body, 'kesto', $suoritus->kesto);
  $suoritus->harjoitusId = tarkistaData($body, 'harjoitusId', $suoritus->harjoitusId);

  $onnistuiko = Suoritukset::paivita(
    $db,
    puhdistaTagit($suoritus->suoritusId),
    puhdistaTagit($suoritus->kayttajatunnus),
    puhdistaTagit($suoritus->paivays),
    puhdistaTagit($suoritus->kesto),
    puhdistaTagit($suoritus->harjoitusId)
  );

  if ($onnistuiko)
  {
    http_response_code(Status::UPDATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // PAIVITA_SUORITUS_END 


// POISTA_SUORITUS ===========================================================================
function poistaSuoritus()
{
  header('Access-Control-Allow-Methods: DELETE');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  $suoritusId = tarkistaId($body, 'suoritusId');

  $suoritus = Suoritukset::hae($db, $suoritusId);

  if (!isset($suoritus->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Poistettavaa suoritusta ei pystytty löytämään...');
    exit;
  }

  tarkistaOikeus($suoritus->kayttajatunnus);

  // Suoritetaan ja tarkistetaan suorituksen poisto.
  if (Suoritukset::poista($db, $suoritusId))
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // POISTA_SUORITUS_END

?>