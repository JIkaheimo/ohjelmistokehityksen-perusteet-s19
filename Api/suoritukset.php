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
    lahetaViesti('Pyynnösssä tulee olla id.');
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
    !empty($body->kayttajatunnus) &&
    !empty($body->paivays) &&
    !empty($body->harjoitusId) &&
    !empty($body->kesto) &&
    isset($_SESSION['kayttaja']) && 
    ($_SESSION['kayttaja'] == $body->kayttajatunnus)
  )
  {

    $id = Suoritukset::uusi(
      $db,
      $body->kayttajatunnus,
      $body->paivays,
      $body->kesto,
      $body->harjoitusId
    );

    print_r($id);

    if ($id)
    {
      http_response_code(201);
      echo(json_encode(array('viesti' => 'Suoritus lisättiin onnistuneesti.', 'id' => $id)));
    }
    else
    // Tämä käsittelee pyynnössä tapahtuneen errorin.
    {
      http_response_code(503);
      lahetaViesti('Suoritusta ei pystytty lisäämään.');
    }
  }
  else
  // Jos kaikki tarvittava data ei ole pyynnössä.
  {
    http_response_code(400);
    lahetaViesti('Suoritustaa ei pystytty lisäämään. Annettu data on epäkelpo.');
  }
  exit;
} // LISAA_SUORITUS_END 


// PAIVITA_SUORITUS ========================================================================
function paivitaSuoritus()
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    Suoritukset::paivita(
      $db,
      $body->id,
      $body->kayttajatunnus,
      $body->paivays,
      $body->kesto,
      $body->harjoitusId
    )
  )
  // Onnistunut päivitys (200)
  {
    http_response_code(200);
    lahetaViesti('Suoritus päivitettiin onnistuneesti.');
  }
  else
  // Epäonnistunut päivitys (503) 
  {
    http_response_code(503);
    echo(json_encode(array('viesti' => 'Suoritustaa ei pystytty päivittää.')));
  }
  exit;
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



  if (Suoritukset::poista($db, $body->id))
  {
    lahetaViesti('Suoritus poistettiin onnistuneesti!');
  }
} // POISTA_SUORITUS_END

?>