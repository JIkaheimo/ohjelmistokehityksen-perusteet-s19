<?php 
  // TODO: Tähän kirjautumisen varmistus.
  /*
   if (!kirjautunut) {
     header('Loca)
   }
  */



  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Uusi ohjelma');
?>

<header>
  <h1 class="keskella">Uusi ohjelma</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form class="keskita" action="./Api/uusi_ohjelma.php" method="POST">
  <div>
    <label for="ohjelma-nimi">Nimi</label>
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
  <button type="submit" class="nappi-p">Luo ohjelma</button>
</form>


<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>