<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Oma profiili');

  // TODO: Käyttäjän tietojen hakeminen tietokannasta.
?>

<header>
  <h1 class="keskella">Oma profiili</h1>
</header>

<form class="keskita" action="./Api/muokkaa_kayttaja.php" method="POST">
  <div>
    <label for="etunimi">Etunimi</label>
    <input type="text" name="etunimi" id="etunimi" placeholder="Jane">
  </div>

  <div>
    <label for="sukunimi">Sukunimi</label>
    <input type="text" name="sukunimi" id="sukunimi" placeholder="Doe">
  </div>

  <div>
    <label for="profiilikuva">Profiilikuva</label>
    <input type="file" name="profiilikuva" id="profiilikuva">
  </div>

  <div>
    <label for="kuvaus">Kuvaus</label>
    <textarea name="kuvaus" id="kuvaus" cols="30" rows="10" placeholder='Kuvaus itsestäsi...'></textarea>
  </div>

  <div>
    <button class="nappi-p" type="submit">Tallenna</button>
    <a class="nappi nappi-s" href="index_kirjautunut.php">Peruuta</a>
  </div>
</form>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
