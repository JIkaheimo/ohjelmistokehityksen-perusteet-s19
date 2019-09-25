
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
    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Testaaja123"
      />
      <div>
        <h3>Testaaja123</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=1">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Salihirmu88"
      />
      <div>
        <h3>Salihirmu88</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=2">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Juoksujäbä"
      />
      <div>
        <h3>Juoksujäbä</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=3">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Tennistyttö"
      />
      <div>
        <h3>Tennistyttö</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=4">Profiili</a>
      </div>
    </section>
  </div>
</section>

<section>
  <header>
    <h2>Seuratut</h2>
  </header>
  <div id="seuratut" class="sailio">
    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Testaaja123"
      />
      <div>
        <h3>Testaaja123</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=1">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Salihirmu88"
      />
      <div>
        <h3>Salihirmu88</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=2">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Juoksujäbä"
      />
      <div>
        <h3>Juoksujäbä</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=3">Profiili</a>
      </div>
    </section>

    <section class="kayttaja">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Tennistyttö"
      />
      <div>
        <h3>Tennistyttö</h3>
        <a class="nappi nappi-p" href="kayttaja.php?id=4">Profiili</a>
      </div>
    </section>
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
      <input type="text" name="kayttaja" id="kayttaja" />
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
