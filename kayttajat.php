<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Käyttäjät');

  // TODO: Tarkista että käyttäjä on kirjautunut
?>

<header>
  <h1>Käyttäjät</h1>
</header>

<section>
  <header>
    <h2>Suosituimmat</h2>
  </header>
  <div id="suosituimmat" class="sailio">
    <?php
      require_once(__DIR__.'/Komponentit/Kayttajat/kayttaja_section.php');

      // TODO: Korvaa "suosituimpien" käyttäjien (4) haulla tietokannasta ja foreach-loopilla.
      KayttajaSection('Testaaja123', null, 1);
      KayttajaSection('Salihirmu88', null, 2);
      KayttajaSection('Juoksujäbä', null, 3);
      KayttajaSection('Tennistyttö', null, 4);
    ?>
  </div>
</section>

<section>
  <header>
    <h2>Seuratut</h2>
  </header>
  <div id="seuratut" class="sailio">
    <?php
      require_once(__DIR__.'/Komponentit/Kayttajat/kayttaja_section.php');

      // TODO: Korvaa seurattujen käyttäjien (oman ID perusteella) haulla tietokannasta ja foreach-loopilla.
      KayttajaSection('Testaaja123', null, 1);
      KayttajaSection('Salihirmu88', null, 2);
      KayttajaSection('Juoksujäbä', null, 3);
      KayttajaSection('Tennistyttö', null, 4);
    ?>
  </div>
</section>

<section id="kaikki-kayttajat">
  <header>
    <h2 class="keskella">Hae käyttäjiä</h2>
  </header>
  
  <!-- TODO: Hae käyttäjät AJAXin avulla kun jokin kenttä muuttuu -->
  <form class="keskita" action="#">
    <div>
      <label for="kayttaja">Nimi</label>
      <input type="text" name="kayttaja" id="kayttaja">
    </div>
    <div>
      <label for="jarjestys">Järjestä</label>
      <select name="jarjestys" id="jarjestys">
        <option>seurausten mukaan</option>
        <option>ohjelmien lisäysten mukaan</option>
        <option>nimen mukaan</option>
      </select>
    </div>

  </form>
</section>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
