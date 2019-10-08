<?php

require_once(__DIR__.'/queries.php');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if isset($_GET['id']) haeVaihe();
    else haeVaiheet();
  case 'POST':
    lisaaVaihe();
    exit;
}


// HAE_VAIHE ==================================================
function haeVaihe()
{
  header('Access-Control-Allow-Methods: GET');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

} // HAE_VAIHE_END


// HAE_VAIHEET ===============================================
function haeVaiheet()
{
  header('Access-Control-Allow-Methods: GET');

  global $db;
} // HAE_VAIHEET_END


// LISAA_VAIHE ================================================
function lisaaVaihe()
{
  header('Access-Control-Allow-Methods: POST');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    !isset($body->harjoitusId) ||
    !isset($body->nimi)
  )
  {
    http_response_code(Status::INVALID);
    exit;
  }

  $kuvaus = $body->kuvaus ?? '';
  $ohjelinkki = $body->ohjelinkki ?? '';

  Vaiheet::uusi(
    $db,
    $body->harjoitusId,
    $body->nimi,
    $ohjelinkki,
    $kuvaus
  );
} // LISAA_VAIHE_END

?>