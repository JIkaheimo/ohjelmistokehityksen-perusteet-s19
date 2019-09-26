<?php
  
  // Salli vain POST-pyynnöt 
  if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header('Location: ./../401.php');
    exit;
  }

  // Varmista että pyynnön rungossa on tarvittavat tiedot
  if (!isset($_POST['kayttajatunnus']) || !isset($_POST['salasana'])) {
    header('Location: ./../400.php');
    exit;
  }

  $kayttajatunnus = $_POST['kayttajatunnus'];
  $salasana = $_POST['salasana'];

  // TODO: Salasanan hashin haku ja varmistus käyttäjänimen perusteella
  // $salasanaHash = ?
  //
  // if (password_verify($salasana, $salasanaHash, PASSWORD_BCRYPT) {
  // 
  // }

  // TODO: Aseta käyttäjän ID talteen sessioon myöhempiä hakuja ja authorisaatiota varten

  session_start();

  // Sallitaan kaikki kirjautumiset testaamisen nimissä
  $_SESSION['kirjautunut'] = true;
  $_SESSION['kayttaja'] = $kayttajatunnus;

  // Ohjataan takaisin kirjautuneen sivulle
  header('Location: ./../index_kirjautunut.php');
?>