<?php

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

// Ohjataan pyyntö oikealle käsittelijälle.
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    haeLisaykset();
    exit;
  case 'POST':
    lisaaLisays();  
    exit;
  case 'DELETE':
    poistaLisays();
    exit;
}

// HAE_LISAYKSET ============================================
function haeLisaykset()
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  echo(json_encode(array('lisäykset' => Lisaykset::hae($db))));
} // HAE_LISAYKSET_END


// LISAA_LISAYS =============================================
function lisaaLisays()
{
  header('Access-Control-Allow-Methods: POST');
  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  print_r($body);

  Lisaykset::uusi(
    $db,
    $body->kayttajatunnus,
    $body->ohjelmaId
  );

} // LISAA_LISAYS_END


// POISTA_LISAYS ============================================
function poistaLisays()
{
  header('Access-Control-Allow-Methods: DELETE');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  Lisaykset::poista(
    $db,
    $body->kayttajatunnus,
    $body->ohjelmaId
  );

} // POISTA_LISAYS_END

?>