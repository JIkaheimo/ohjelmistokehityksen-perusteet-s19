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
  case 'PUT':
    // Lisäyksiä ei pysty päivittämään.
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
/**
 * Hakee tietokannassa olevat ohjelmat ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  $lisaykset = Lisaykset::hae($db);

  // Tarkistetaan löytyikö lisäyksiä.
  if (empty($lisaykset))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Lisäyksiä ei löydetty.');
  }
  else
  {
    echo(json_encode(array('lisäykset' => $lisaykset)));
  }
} // HAE_LISAYKSET_END


// LISAA_LISAYS =============================================
function lisaaLisays()
/**
 * Hoitaa JSON-formaatissa olevan lisäyksen lisäämisen tietokantaan.
 * 
 * TARVITTAVA DATA:
 * - kayttajatunnus 
 * - ohjelmaId
 */
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  // Tarkistetaan pyynnön runko.
  if (
    !tarkistaData($body, 'kayttajatunnus') ||
    !tarkistaData($body, 'ohjelmaId')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Lisäystä ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  // Annetaan käyttäjän lisätä vain itselleen.
  tarkistaOikeus($body->kayttajatunnus);

  // Tarkistetaan onnistuiko lisäyksen luonti.
  $onnistuiko = Lisaykset::uusi(
    $db,
    puhdistaTagit($body->kayttajatunnus),
    puhdistaTagit($body->ohjelmaId)
  );

  if ($onnistuiko)
  {
    http_response_code(Status::CREATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }

} // LISAA_LISAYS_END


// POISTA_LISAYS ============================================
function poistaLisays()
/**
 * Hoitaa lisäyksen poiston tietokannasta annetun käyttäjätunnuksen 
 * ja ohjelman id:n perusteella.
 * 
 * TARVITTAVA DATA:
 * - kayttajatunnus
 * - ohjelmaId
 */
{   
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  header('Access-Control-Allow-Methods: DELETE');

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  if (
    !tarkistaData($body, 'kayttajatunnus') ||
    !tarkistaData($body, 'ohjelmaId')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Lisäystä ei pystytty poistamaan. Annettu data on epäkelpo.');
    exit;
  }

  tarkistaOikeus($body->kayttajatunnus);

  $onnistuiko = Lisaykset::poista(
    $db,
    $body->kayttajatunnus,
    $body->ohjelmaId
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

} // POISTA_LISAYS_END

?>