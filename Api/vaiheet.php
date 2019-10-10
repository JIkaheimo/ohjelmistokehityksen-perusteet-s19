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
}


// HAE_VAIHE ==================================================
function haeVaihe()
{
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Credentials: true");
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
    !isset($body->harjoitusId) ||
    !isset($body->nimi)
  )
  {
    http_response_code(Status::INVALID);
    exit;
  }

  // Täytetään tyhjä data nulleilla.
  $ohjelinkki = isset($body->ohjelinkki) ? $body->ohjelinkki : null;
  $kuvaus = isset($body->kuvaus) ? $body->kuvaus : null;

  // Luodaan uusi vaihe
  $id= Vaiheet::uusi(
    $db,
    $body->harjoitusId,
    $body->nimi,
    $ohjelinkki,
    $kuvaus
  );

  // Jos vaiheen lisääminen onnistuu, palautetaan luotu tietue.
  if ($id) 
  {
    $vaihe = Vaiheet::hae($db, $id);
    echo(json_encode($vaihe)); 
  } 
  else 
  {
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
  if (empty($vaihe))
  {
    http_response_code(Status::NOT_FOUND);
  }

  // Pidetään huoli että päivitetään vain annettu data.
  $nimi = isset($body->nimi) ? $body->nimi : $vaihe->nimi;
  $kuvaus = isset($body->kuvaus) ? $body->kuvaus : $vaihe->kuvaus;
  $harjoitusId = isset($body->harjoitusId) ? $body->harjoitusId : $vaihe->harjoitusId;
  $ohjelinkki = isset($body->ohjelinkki) ? $body->ohjelinkki : $vaihe->ohjelinkki;

  // Suoritetaan päivitys.
  $onnistuiko = Vaiheet::paivita(
    $db,
    $vaiheId,
    $harjoitusId,
    $nimi,
    $ohjelinkki,
    $kuvaus
  );

  // Testataan onnistuminen.
  if (!$onnistuiko) 
  {
    http_response_code(Status::DATABASE_ERROR);
  }
  else
  {
    http_response_code(Status::UPDATED);
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

  global $db;
  
  $vaiheId = tarkistaId($body, 'vaiheId');

  // Tarkistetaan onko vaihe olemassa.
  $vaihe = Vaiheet::hae($db, $vaiheId);
  if (empty($vaihe))
  {
    http_response_code(Status::NOT_FOUND);
  }
} // POISTA_VAIHE_END


?>