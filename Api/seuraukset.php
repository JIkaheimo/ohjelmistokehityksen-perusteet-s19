<?php

require_once(__DIR__.'/queries.php');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

// Ohjataan pyyntö oikealle käsittelijälle.
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    haeSeuraukset();
    exit;
  case 'POST':
    lisaaSeuraus();  
    exit;
  case 'DELETE':
    poistaSeuraus();
    exit;
}

// HAE_SEURAUKSET ============================================
function haeSeuraukset()
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  echo(json_encode(array('lisäykset' => Seuraukset::hae($db))));
} // HAE_SEURAUKSET_END


// LISAA_SEURAUS =============================================
function lisaaSeuraus()
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  Seuraukset::uusi(
    $db,
    $body->seuraaja,
    $body->seurattava
  );

} // LISAA_SEURAUS_END


// POISTA_SEURAUS ============================================
function poistaSeuraus()
{
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  header('Access-Control-Allow-Methods: DELETE');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  Seuraukset::poista(
    $db,
    $body->seuraaja,
    $body->seurattava
  );

} // POISTA_SEURAUS_END

?>