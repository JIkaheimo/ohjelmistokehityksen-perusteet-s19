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
    http_response_code(Statis::INVALID);
    lahetaViesti('Palvelin ei tunnistanut pyyntöä.');
}

// HAE_OHJELMA ========================================================
function haeOhjelma()
/**
 * Hakee tietokannassa olevan yksittäisen ohjelman
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
  
  // Ohjelman pystyy hakemaan joko pyynnön rungon tai hakukentän parametrillä.
  if (!isset($body->id) && !isset($_GET['id']))
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Pyynnössä tulee olla id.');
    exit;
  }

  // Haetaan ohjelma joko parametrina tai pyynnön rungossa välitetyn id:n avulla.
  $id = isset($_GET['id']) ? $_GET['id'] : $body->id;
  
  $ohjelma = Ohjelmat::hae($db, $id);

  if (!isset($ohjelma->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Ohjelmaa ei löydetty.');
  }
  else
  {
    echo(json_encode($ohjelma));
  }
  
} // HAE_OHJELMA_END


// HAE_OHJELMAT =======================================================
function haeOhjelmat()
/**
 * Hakee tietokannassa olevat ohjelmat ja lähettää ne JSON-formaatissa.
 */
{
  header('Access-Control-Allow-Methods: GET');

  global $db;

  $ohjelmat = Ohjelmat::hae($db);

  if (empty($ohjelmat))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Ohjelmia ei löydetty.');
  }
  else
  {
    echo(json_encode(array('ohjelmat' => $ohjelmat)));
  }
} // HAE_OHJELMAT_END


// LISAA_OHJELMA ======================================================
function lisaaOhjelma() 
/**
 * Hoitaa JSON-formaatissa olevan ohjelman lisäyksen tietokantaan.
 * Lähettää vastauksena luodun ohjelman takaisin.
 * 
 * TARVITTAVA DATA:
 * - nimi
 * - vaikeustasoId
 * - kayttajatunnus
 * 
 * VAIHTOEHTOINEN DATA:
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
    !tarkistaData($body, 'nimi') ||
    !tarkistaData($body, 'vaikeustasoId') ||
    !tarkistaData($body, 'kayttajatunnus')
  )
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Ohjelmaa ei pystytty lisäämään. Annettu data on epäkelpo.');
    exit;
  }

  tarkistaOikeus($body->kayttajatunnus);

  $kuva = tarkistaData($body, 'kuva', 'ohjelma-placeholder.png');

  // Yritetään lisätä ohjelma tietokantaan.
  $id = Ohjelmat::lisaa(
    $db,
    puhdistaTagit($body->kayttajatunnus),
    puhdistaTagit($body->nimi),
    puhdistaTagit($body->vaikeustasoId),
    puhdistaTagit($kuva)
  );

  // Palautetaan luotu ohjelma jos sen luominen onnistui.
  if ($id)
  {
    $ohjelma = Ohjelmat::hae($db, $id);
    http_response_code(Status::CREATED);
    echo(json_encode($ohjelma));
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // LISAA_OHJELMA_END


// PAIVITA_OHJELMA ======================================================
function paivitaOhjelma()
/**
 * Hoitaa JSON-formaatissa olevan ohjelman tietojen päivityksen tietokantaan.
 * 
 * !HOX! Jos annetaan pelkkä ohjelman id, data ei muutu tietokannassa ollenkaan...
 * 
 * TARVITTAVA DATA:
 * - id / ohjelmaId päivitettävän ohjelman id
 * 
 * VAIHTOEHTOINEN DATA:
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

  // Haetaan päivitettävä ohjelma.
  $ohjelmaId = tarkistaId($body, 'ohjelmaId');
  $ohjelma = Ohjelmat::hae($db, $ohjelmaId);

  if (!isset($ohjelma->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Päivitettävää ohjelmaa ei pystytty löytämään...');
    exit;
  }

  // Sallitaan vain ohjelman luoneen käyttäjän päivittää ohjelma...
  tarkistaOikeus($ohjelma->kayttajatunnus);

  // Tarkistetaan päivitettävä data.
  $ohjelma->kuva = tarkistaData($body, 'kuva', $ohjelma->kuva);

  // (laita ohjelmalle placeholder-kuva jos kuvaa ei ole).
  $ohjelma->kuva = empty($ohjelma->kuva) ? 'ohjelma-placeholder.png' : $ohjelma->kuva;
  
  $ohjelma->vaikeustasoId = tarkistaData($body, 'vaikeustasoId', $ohjelma->vaikeustasoId);
  $ohjelma->nimi = tarkistaData($body, 'nimi', $ohjelma->nimi);
  $ohjelma->kayttajatunnus = tarkistaData($body, 'kayttajatunnus', $ohjelma->kayttajatunnus);

  // Suoritetaan päivitys.
  $onnistuiko = Ohjelmat::paivita(
    $db,
    puhdistaTagit($ohjelma->ohjelmaId),
    puhdistaTagit($ohjelma->kayttajatunnus),
    puhdistaTagit($ohjelma->nimi),
    puhdistaTagit($ohjelma->vaikeustasoId),
    puhdistaTagit($ohjelma->kuva)
  );  
  
  // Tarkistetaan vielä että päivitys onnistui.
  if ($onnistuiko)
  {
    http_response_code(Status::UPDATED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // PAIVITA_OHJELMA_END


// POISTA_OHJELMA ====================================================
function poistaOhjelma()
/**
 * Hoitaa ohjelman poiston tietokannasta annetun id:n perusteella.
 * 
 * TARVITTAVA DATA:
 * - id / harjoitusId
 */
{
  header('Access-Control-Allow-Methods: DELETE');
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  $body = json_decode(file_get_contents('php://input'));

  $ohjelmaId = tarkistaId($body, 'ohjelmaId');
  
  global $db;

  // Tarkistetaan että ohjelma on olemassa ja 
  // että vain ohjelman luonut käyttäjä saa sen poistaa.
  $ohjelma = Ohjelmat::hae($db, $ohjelmaId);

  if (!isset($ohjelma->kayttajatunnus))
  {
    http_response_code(Status::NOT_FOUND);
    lahetaViesti('Poistettavaa ohjelmaa ei pystytty löytämään...');
    exit;
  }

  tarkistaOikeus($ohjelma->kayttajatunnus);

  // Suoritetaan ja tarkistetaan ohjelman poisto.
  if (Ohjelmat::poista($db, $ohjelmaId))
  {
    http_response_code(Status::DELETED);
  }
  else
  {
    lahetaViesti('Tapahtui virhe pyynnön käsittelyssä...');
    http_response_code(Status::DATABASE_ERROR);
  }
} // POISTA_OHJELMA_END


?>