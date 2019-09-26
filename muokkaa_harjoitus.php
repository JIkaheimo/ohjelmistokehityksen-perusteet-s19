<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }
  // TODO: Tähän kirjautumisen varmistus.
  /*
   if (!kirjautunut) {
     header('Loca)
   }
  */

  $harjoitusID = $_GET['id'];

  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Muokkaa harjoitusta');
?>

<header>
  <h1 class="keskella">Muokkaa harjoitusta</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form class="keskita" action="./Api/muokkaa_harjoitus.php" method="POST">
  <input type="hidden" name="harjoitus-id" id="harjoitus-id" value=<?=$harjoitusID?>>
  <div>
    <label for="harjoitus-nimi">Harjoituksen nimi</label>
    <input type="text" name="harjoitus-nimi" id="harjoitus-nimi" value="Vatsa">
  </div>

  <button type="submit" class="nappi-p">Päivitä tiedot</button>
  <a href="muokkaa_ohjelma.php?id=123" class="nappi nappi-s">Peruuta</a>
</form>

<form class="valia keskita" action="./Api/uusi_vaihe.php" method="POST">
  <div>
    <label for="uusi-vaihe">Vaiheen nimi</label>
    <input type="text" name="uusi-vaihe" id="uusi-vaihe">
  </div>
  <button type="submit" class="nappi-p">Lisää vaihe +</button>
</form>

<table>   
 <thead>
  <tr>
    <th>Vaihe</th>
    <th>Kuvaus</th>
    <th>Ohjelinkki</th>
    <th></th>
  </tr>
</thead>
  <tbody>
    <?php
      require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

      VaiheTR('Vatsalihaskone', 'Sed vitae purus nec nulla volutpat gravida vestibulum a purus.', null, 1);
      VaiheTR('Vino vatsalihaspenkki', 'Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur ligula, in hendrerit est.', 'https://www.google.fi', 2);
      VaiheTR('Ilmapyörä', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 3);
      VaiheTR('Jalannosto', 'Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.', null, 4);
      VaiheTR('Juoksu', 'Nulla nec quam et mi rhoncus gravida.  Quisque ac consectetur ligula, in hendrerit est.', null, 5);
    ?>
  </tbody>
</table>

 
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
