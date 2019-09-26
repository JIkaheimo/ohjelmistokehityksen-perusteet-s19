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

  $ohjelmaID = $_GET['id'];

  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Muokkaa ohjelmaa');
?>

<header>
  <h1 class="keskella">Muokkaa ohjelmaa</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form class="keskita" action="./Api/muokkaa_ohjelma.php" method="POST">
  <input type="hidden" name="ohjelma-id" id="ohjelma-id" value=<?=$ohjelmaID?>>
  <div>
    <label for="ohjelma-nimi">Ohjelman nimi</label>
    <input type="text" name="ohjelma-nimi" id="ohjelma-nimi" value="4-jakoinen saliohjelma edistyneille">
  </div>
  <div>
    <label for="ohjelma-vaikeus">Vaikeustaso</label>
    <select name="ohjelma-vaikeus" id="ohjelma-vaikeus">
      <option>Aloittelija</option>
      <option>Helppo</option>
      <option>Haastava</option>
      <option>Vaikea</option>
      <option>Extreme</option>
    </select>
  </div>
  <button type="submit" class="nappi-p">Päivitä tiedot</button>
  <a href="ohjelmani.php" class="nappi nappi-s">Peruuta</a>
</form>



<form class="valia keskita" action="./Api/uusi_harjoitus.php" method="POST">
  <div>
    <label for="uusi-harjoitus">Harjoituksen nimi</label>
    <input type="text" name="uusi-harjoitus" id="uusi-harjoitus">
  </div>
  <button type="submit" class="nappi-p">Lisää harjoitus +</button>
</form>
  

<section class="keskita">
  <header>
    <h2 class="keskella">Harjoitukset</h2>
  </header>

  <div class="sailio keskita">
    <?php require_once(__DIR__.'/Komponentit/Harjoitukset/harjoitus_section.php');
      HarjoitusSection('Vatsa', 1);
      HarjoitusSection('Selkä/Hauis', 2);
      HarjoitusSection('Jalat/Olkapäät', 3);
      HarjoitusSection('Rinta/Ojentajat', 4);
    ?> 
  </div>
</section>
 

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
