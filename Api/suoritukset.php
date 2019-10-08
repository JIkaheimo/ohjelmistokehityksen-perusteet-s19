<?php

require_once(__DIR__.'/queries.php');
header('Content-Type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

// Ohjataan pyyntö oikealle käsittelijälle
switch ($_SERVER['REQUEST_METHOD'])
{
  case 'GET':
    haeSuoritukset();
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

// HAE_SUORITUKSET =============================================================
function haeSuoritukset()
{
  header('Access-Control-Allow-Methods: GET');
  $body = json_decode(file_get_contents('php://input'));

  global $db;

  $suoritukset = Suoritukset::hae($db);
  echo(json_encode(array('suoritukset' => $suoritukset)));

} // HAE_SUORITUKSET_END


// LISAA_SUORITUS ===============================================================
function lisaaSuoritus() 
{
  header('Access-Control-Allow-Methods: POST');
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
  $body = json_decode(file_get_contents('php://input'));
  global $db;

  // Tarkistetaan että poistettavan suorituksen id on annettu.
  if (!isset($body->id)) 
  {
    http_response_code(Status::INVALID);
    lahetaViesti('Anna poistettavan suorituksen id.');
    exit;
  }

  if (Suoritukset::poista($db, $body->id))
  {
    lahetaViesti('Suoritus poistettiin onnistuneesti!');
  }
}

?>