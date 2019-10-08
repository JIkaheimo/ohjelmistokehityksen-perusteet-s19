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
  public const OK = 200;
  public const DATABASE_ERROR = 500;
  public const INVALID = 422;
  public const NOT_FOUND = 404;
  public const DELETED = 200;
  public const CREATED = 201;
}

?>