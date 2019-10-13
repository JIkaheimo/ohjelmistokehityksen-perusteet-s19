<?php

require_once(__DIR__.'/queries.php');

header('Access-Control-Allow-Methods: POST');
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
header("Access-Control-Allow-Origin: *");

$body = json_decode(file_get_contents('php://input'));


if (!isset($body->kayttajatunnus) || !isset($body->salasana))
{
  http_response_code(400);
  lahetaViesti('Anna kayttajatunnus ja salasana...');
  exit;
}

if (Kayttajat::kayttaja($db, $body->kayttajatunnus))
{
  http_response_code(403);
  lahetaViesti('Käyttäjätunnus on varattu...');
  exit;
}

$salasanaHash = password_hash($body->salasana, PASSWORD_BCRYPT);
Kayttajat::uusiKayttaja($db, $body->kayttajatunnus, $salasanaHash);

session_start();
$_SESSION['kirjautunut'] = true;
$_SESSION['kayttaja'] = $body->kayttajatunnus;

lahetaViesti('Rekisteröityminen onnistui!');

?>