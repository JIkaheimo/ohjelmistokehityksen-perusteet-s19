<?php

// Liitetään kaikki tarvittava API-funktionaalisuus.
require_once(__DIR__.'/Config/database.php');

require_once(__DIR__.'/Queries/Kayttajat.php');
require_once(__DIR__.'/Queries/Suoritukset.php');
require_once(__DIR__.'/Queries/Ohjelmat.php');
require_once(__DIR__.'/Queries/Harjoitukset.php');
require_once(__DIR__.'/Queries/Vaikeustasot.php');
require_once(__DIR__.'/Queries/Vaiheet.php');
require_once(__DIR__.'/Queries/Lisaykset.php');
require_once(__DIR__.'/Queries/Seuraukset.php');


// TARKISTA_DATA ==========================================================
function tarkistaData($data, $kentta, $dataJosTyhja = true) 
/**
 * Tarkistaa onko annettu data asetettu, jos ei niin käytetään placeholderia.
 */
{
  return (isset($data->$kentta) && !empty($data->$kentta)) ? $data->$kentta : $dataJosTyhja;
} // TARKISTA_DATA_END


// TARKISTA_ID ===========================================================
function tarkistaId($body, $idKentta)
/**
 * Tarkistaa onko id annettu JSON-rungossa.
 */
{
  // Jos id:tä ei ole, annetaan INVALID-status vastauksena.
  if (!isset($body->$idKentta) && empty($body->$idKentta) && 
    !isset($body->id) && empty($body->id))
  {
    http_response_code(Status::INVALID);
    exit;
  }

  // Palautetaan se vaihtoehto kummassa on id annettuna.
  return isset($body->$idKentta) ? $body->$idKentta : $body->id;

} // TARKISTA_ID_END


// TARKISTA_OIKEUS ========================================================
function tarkistaOikeus($kayttaja) 
/**
 * Tarkistaa onko resurssi käyttäjän käytettävissä.
 */
{
  session_start();
  if ($kayttaja !== $_SESSION['kayttaja'])
  {
    http_response_code(Status::NOT_ALLOWED);
    exit;
  }

} // TARKISTA_OIKEUS_END


// PUHDISTA_TAGIT =========================================================
function puhdistaTagit($data)
{
  return html_entity_decode(strip_tags($data));
} // PUHDISTA_TAGIT_END


// LAHETA_VIESTI ===========================================================
function lahetaViesti($viesti)
{
  echo(json_encode(array('viesti' => $viesti)));
} // LAHETA_VIESTI_END


abstract class Status 
{
  const OK = 200;
  const NOT_ALLOWED = 403;
  const DATABASE_ERROR = 500;
  const INVALID = 400;
  const NOT_FOUND = 404;
  const DELETED = 204;
  const UPDATED = 204;
  const CREATED = 201;
}

?>