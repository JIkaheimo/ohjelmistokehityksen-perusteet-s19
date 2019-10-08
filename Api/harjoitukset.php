<?php 

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if (isset($_GET['id']))
    {
      haeHarjoitus();
    }
    elseif (isset($_GET['ohjelma']))
    {
      haeOhjelmanHarjoitukset();
    }
    else
    {
      haeHarjoitukset();
    }
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
    http_response_code(403);
}


// HAE_HARJOITUS =========================================================
function haeHarjoitus()
{
  header('Access-Control-Allow-Methods: GET');
  global $db;

  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    latehaViesti('Anna haettavan harjoituksen id.');
  }

  $harjoitus = Harjoitukset::hae($db, $_GET['id']);

  if ($harjoitus)
  {
    echo(json_encode($harjoitus));
  }
  else
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoitusta ei löydetty.');
  }
} // HAE_HARJOITUS_END


// HAE_HARJOITUKSET ========================================================
function haeHarjoitukset()
{
  header('Access-Control-Allow-Methods: GET');
  global $db;

  $harjoitukset = Harjoitukset::hae($db);
  
  if ($harjoitukset == null)
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Harjoituksia ei löydetty.');
    exit;
  }

  echo(json_encode(array('harjoitukset' => $harjoitukset)));
} // HAE_HARJOITUKSET_END


// HAE_OHJELMAN_HARJOITUKSET ===============================================
function haeOhjelmanHarjoitukset() 
{
  header('Access-Control-Allow-Methods: GET');
  
  global $db;

  $ohjelmaId = $_GET['ohjelma'];
  $harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelmaId);

  if (count($harjoitukset) > 0) 
  {
    http_response_code(200);
    echo(json_encode(array('harjoitukset' => $harjoitukset)));
  } 
  else 
  {
    http_response_code(404);
    lahetaViesti('Harjoituksia ei löydetty.');   
  }
} // HAE_OHJELMAN_HARJOITUKSET_END 


// LISAA_HARJOITUS ========================================================
function lisaaHarjoitus() 
{
  header('Access-Control-Allow-Methods: POST');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    !isset($body->nimi) ||
    !isset($body->ohjelmaId)
  )
  {
    http_response_code(Status::Invalid);
    lahetaViesti('Harjoitusta ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  $id = Harjoitukset::uusi($db, $body->nimi, $body->ohjelmaId);

  if ($id)
  {
    
  }
  else
  {
    http_response_code(Status::DATABASE_ERROR);
  }
} // LISAA_HARJOITUS_END


// PAIVITA_HARJOITUS =====================================================
function paivitaHarjoitus() 
{

} // PAIVITA_HARJOITUS_END


// POISTA_HARJOITUS ======================================================
function poistaHarjoitus() 
{
  header('Access-Control-Allow-Methods:DELETE');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (!isset($body->id))
  {
    http_response_code(Status::Invalid);
    lahetaViesti('Harjoitusta ei pystytty poistamaan. 
      Pyynnössä tulisi olla poistettavan harjoituksen id.');
    return;
  }

  if (Harjoitukset::poista($db, $body->id))
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    http_response_code(Status::DATABASE_ERROR);
  }

} // POISTA_HARJOITUS_END 

?>