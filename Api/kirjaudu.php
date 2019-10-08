<?php

require_once(__DIR__.'/queries.php');
header("Access-Control-Allow-Origin: *");

header('Access-Control-Allow-Methods: POST');
$body = json_decode(file_get_contents('php://input'));

if (!isset($body->kayttajatunnus) || !isset($body->salasana))
{
  http_response_code(400);
  lahetaViesti('Anna kayttajatunnus ja salasana...');
  exit;
}

$kayttaja = Kayttajat::kayttajaSalasanalla($db, $body->kayttajatunnus);

if (!empty($kayttaja) && password_verify($body->salasana, $kayttaja->salasanaHash))
{
  session_start();
  $_SESSION['kirjautunut'] = true;
  $_SESSION['kayttaja'] = $kayttaja->kayttajatunnus;

  http_response_code(200);
  lahetaViesti('Kirjautuminen onnistui!');
}
else
{
  http_response_code(404);
  lahetaViesti('Käyttäjätunnus tai salasana on virheellinen...');
}


?>