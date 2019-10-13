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

  echo(json_encode(array('seuraukset' => Seuraukset::hae($db))));
} // HAE_SEURAUKSET_END


// LISAA_SEURAUS =============================================
function lisaaSeuraus()
/**
 * Lisää seurauksen tietokantaan.
 * 
 * TARVITTAVA DATA:
 * - seuraaja
 * - seurattava
 */
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  global $db;

  $id = Seuraukset::uusi(
    $db,
    $body->seuraaja,
    $body->seurattava
  );

  if ($id)
  {
    http_response_code(Status::CREATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // LISAA_SEURAUS_END


// POISTA_SEURAUS ============================================
function poistaSeuraus()
/**
 * Poistaa seurauksen tietokannasta.
 * 
 * TARVITTAVA DATA:
 * - seuraaja
 * - seurattava
 */
{
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  header('Access-Control-Allow-Methods: DELETE');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    !tarkistaData($body, 'seuraaja') ||
    !tarkistaData($body, 'seurattava')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Seurausta ei pystytty poistamaan. Annettu data on epäkelpo.');
    exit;
  }

  tarkistaOikeus($body->seuraaja);

  $onnistuiko = Seuraukset::poista(
    $db,
    $body->seuraaja,
    $body->seurattava
  );

  if ($onnistuiko)
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // POISTA_SEURAUS_END

?>