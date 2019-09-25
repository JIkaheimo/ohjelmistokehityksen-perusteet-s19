<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Muokkaa vaihetta');

  // TODO: Käyttäjän tietojen hakeminen tietokannasta.
?>

<header>
  <h1 class="keskella">Muokkaa vaihetta</h1>
</header>

<form class="keskita" action="./Api/muokkaa_vaihe.php" method="POST">
  <div>
    <label for="nimi">Nimi:</label>
    <input type="text" name="nimi" id="nimi" placeholder="Maastaveto" />
  </div>

  <div>
    <label for="kuvaus">Kuvaus:</label>
    <textarea
      name="kuvaus"
      id="kuvaus"
      cols="30"
      rows="10"
      placeholder="Lyhyt kuvaus harjoituksesta..."
    ></textarea>
  </div>

  <div>
    <label for="linkki">Linkki:</label>
    <input
      type="text"
      name="linkki"
      id="linkki"
      placeholder="https://www.google.fi"
    />
  </div>

  <div>
    <button class="nappi-p" type="submit">Tallenna</button>
    <a class="nappi nappi-s" href="muokkaa_harjoitus.php?id=123"
      >Peruuta</a
    >
  </div>
</form>
    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
