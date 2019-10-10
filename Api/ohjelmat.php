<?php 

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=UTF-8');

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    if (isset($_GET['id'])) haeOhjelma();
    else haeOhjelmat();
    exit;
  case 'POST':
    lisaaOhjelma();
    exit;
  case 'PUT':
    paivitaOhjelma();
    exit;
  case 'DELETE':
    poistaOhjelma();
    exit;
  default:
    http_response_code(403);
    lahetaViesti('Palvelin ei tunnistanut pyyntöä.');
}

// HAE_OHJELMA ========================================================
function haeOhjelma()
/**
 * Hakee tietokannassa olevan yksittäisen ohjelman ja palauttaa sen json_formaatissa
 */
{
  header("Access-Control-Allow-Headers: access");
  header("Access-Control-Allow-Credentials: true");
  header('Access-Control-Allow-Methods: GET');

  $body = json_decode(file_get_contents('php://input'));

  global $db;
  
  // Ohjelman pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    exit;
  }

  // Haetaan ohjelma joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $id = isset($_GET['id']) ? $_GET['id'] : $body->id;
  
  $ohjelma = Ohjelmat::hae($db, $id);


  echo(json_encode($ohjelma));
} // HAE_OHJELMA_END


// HAE_OHJELMAT =======================================================
function haeOhjelmat()
/**
 * Hakee tietokannassa olevat ohjelmat ja palauttaa ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  $ohjelmat = Ohjelmat::hae($db);

  echo(json_encode(array('ohjelmat' => $ohjelmat)));
} // HAE_OHJELMAT_END


// LISAA_OHJELMA ======================================================
function lisaaOhjelma() 
/**
 * Hoitaa JSON-formaatissa olevan ohjelman lisäyksen tietokantaan.
 * 
 * Tarvittava data:
 * - nimi
 * - vaikeustasoId
 * - kayttajatunnus
 * 
 * Vaihtoehtoinen data:
 * - kuva
 */
{
  header('Access-Control-Allow-Methods: POST');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  global $db;

  // Tarkistetaan pyynnön runko.
  if (
    !isset($body->nimi) ||
    !isset($body->vaikeustasoId) ||
    !isset($body->kayttajatunnus)
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Ohjelmaa ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  $kuva = isset($body->kuva) ? $body->kuva : 'ohjelma-placeholder.png';

  // Yritetään lisätä ohjelma tietokantaan.
  $id = Ohjelmat::lisaa(
    $db,
    $body->kayttajatunnus,
    $body->nimi,
    $body->vaikeustasoId,
    $kuva
  );

  if ($id)
  {
    http_response_code(201);
    echo(json_encode(array('viesti' => 'Ohjelma lisättiin.', 'id' => $id)));
  }
  else
  {
    http_response_code(Status::DATABASE_ERROR);
    lahetaViesti('Ohjelmaa ei pystytty lisäämään.');
  }
} // LISAA_OHJELMA_END


// PAIVITA_OHJELMA ======================================================
function paivitaOhjelma()
/**
 * Hoitaa JSON-formaatissa olevan ohjelman tietojen päivityksen tietokantaan.
 * 
 * Tarvittava data:
 * - nimi
 * - vaikeustasoId
 * - kayttajatunnus
 * - kuva
 */
{
  header('Access-Control-Allow-Methods: PUT');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  // Tarkistetaan pyynnön runko.
  if (
    !isset($body->id) ||
    !isset($body->kayttajatunnus) ||
    !isset($body->nimi) ||
    !isset($body->vaikeustasoId) 
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Ohjelmaa ei pystytty päivittämään. Annettu data on epäkelpo.');
    exit;
  }

  $kuva = isset($body->kuva) ? $body->kuva : 'ohjelma-placeholder.png';

  // Suoritetaan ja tarkistetaan ohjelman päivitys.
  if (!Ohjelmat::paivita(
    $db,
    $body->id,
    $body->kayttajatunnus,
    $body->nimi,
    $body->vaikeustasoId,
    $kuva
  ))
  {
    http_response_code(Status::DATABASE_ERROR);
    lahetaViesti('Palvelin ei pystynyt prosessoimaan pyyntöä.');
  }
} // PAIVITA_OHJELMA_END


// POISTA_OHJELMA ====================================================
function poistaOhjelma()
/**
 * Hoitaa ohjelman poiston tietokannasta annetun id:n perusteella.
 * 
 * Tarvittava data:
 * - id (int)
 */
{
  header('Access-Control-Allow-Methods: DELETE');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));
  
  global $db;

  // Suoritetaan ja tarkistetaan ohjelman poisto.
  if (Ohjelmat::poista($db, $body->id))
  {
    http_response_code(Status::OK);
    lahetaViesti('Ohjelma poistettiin onnistuneesti.');
  }
  else
  {
    http_response_code(Status::DATABASE_ERROR);
    lahetaViesti('Ohjelmaa ei pystytty poistamaan.');
  }
} // POISTA_OHJELMA_END

?>