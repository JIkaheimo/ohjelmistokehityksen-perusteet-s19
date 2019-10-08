<?php

require_once(__DIR__.'/Config/database.php');

require_once(__DIR__.'/Queries/Kayttajat.php');
require_once(__DIR__.'/Queries/Suoritukset.php');
require_once(__DIR__.'/Queries/Ohjelmat.php');
require_once(__DIR__.'/Queries/Harjoitukset.php');
require_once(__DIR__.'/Queries/Vaikeustasot.php');
require_once(__DIR__.'/Queries/Vaiheet.php');
require_once(__DIR__.'/Queries/Lisaykset.php');

function puhdistaTagit(string $data)
{
  return html_entity_decode(strip_tags($data));
}

function puhdistaData(string $data, $urlPoisto = true)
{
  $data = puhdistaTagit($data);
  
  if ($urlPoisto)
  {
    $data = urldecode($data);
  }

  $data = preg_replace('/[^A-Za-z0-9.\/]/', ' ', $data);  
  $data = preg_replace('/ +/', ' ', $data);
  return trim($data);
}

function lahetaViesti($viesti)
{
  echo(json_encode(array('viesti' => $viesti)));
}

abstract class Status 
{
  const OK = 200;
  const DATABASE_ERROR = 500;
  const INVALID = 422;
  const NOT_FOUND = 404;
  const DELETED = 200;
  const CREATED = 201;
}

?>