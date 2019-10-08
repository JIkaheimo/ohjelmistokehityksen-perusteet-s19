

<?php 
  // Haetaan yleistä dataa sivustolle
  $kayttaja = null;
  
  require_once(__DIR__.'/../../Api/queries.php');
  
  $db = $database->yhdista();
  
  session_start();
  ob_start();

  if (isset($_SESSION['kayttaja']))
  {
    $kayttaja = $_SESSION['kayttaja'];
  }

  function Headeri($otsikko) { ?>

  <!DOCTYPE html>
  <html lang='fi'>
    <head>
      <meta charset='UTF-8' />
      <meta name='viewport' content='width=device-width, initial-scale=1.0' />
      <meta http-equiv='X-UA-Compatible' content='ie=edge' />
      <title><?= $otsikko; ?> | REENIKIRJA</title>
      <link rel='shortcut icon' href='favicon.ico' type='image/x-icon'>
      <link rel='stylesheet' href='./Styles/main.css'>
      <script src='./Scripts/request.js'></script>
    </head>
    <body>

    <div id='ilmoittaja'>
      <p>Tähän tulee ilmoitus</p>
    </div>

    <?php 
      global $kayttaja;
      if ($kayttaja != null)
      {
        require_once(__DIR__.'/header_kirjautunut.php');
        HeaderKirjautunut($otsikko);
      }
      else {
        require_once(__DIR__.'/header_vieras.php');
        HeaderVieras($otsikko);
      }
    ?>

    <script src='./Scripts/helpers.js'></script>
    <script src='./Scripts/header.js'></script>
   
<?php } ?>