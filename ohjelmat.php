<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Ohjelmat');

  // TODO: Käyttäjän kirjautumisen tarkistus
?>

<header>
  <h1>Ohjelmat</h1>
  <a class="nappi nappi-p" href="ohjelmani.php">Omat ohjelmani</a>
</header>

<section id="suosituimmat">
  <header>
    <h2>Suosituimmat</h2>
  </header>
  <div class="sailio">
    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="4-jakoinen kuntosaliohjelma edistyneille"
      />
      <div>
        <h3>4-jakoinen kuntosaliohjelma edistyneille</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>
  </div>
</section>

<section id="uudet">
  <header>
    <h2>Uudet</h2>
  </header>
  <div class="sailio">
    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="4-jakoinen kuntosaliohjelma edistyneille"
      />
      <div>
        <h3>4-jakoinen kuntosaliohjelma edistyneille</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>

    <section class="ohjelma">
      <img
        class="img img-kehys"
        src="https://www.placehold.it/300x200/200"
        alt="Reeniohjelma jokaiselle"
      />
      <div>
        <h3>Reeniohjelma jokaiselle</h3>
        <p>aloittelija</p>
        <a class="nappi nappi-p" href="ohjelma.php?id=12">Tarkastele</a>
      </div>
    </section>
  </div>
</section>

<section id="kaikki-ohjelmat">
  <header>
    <h2 class="keskita">Hae ohjelmia</h2>
  </header>

  <!-- TODO: Hae ohjelmat AJAXin avulla kun jokin kenttä muuttuu -->
  <form class="keskita" action="#">
    <div>
      <label for="ohjelma">Nimi</label>
      <input type="text" name="ohjelma" id="ohjelma" />
    </div>
    <div>
      <label for="jarjestys">Järjestä</label>
      <select name="jarjestys" id="jarjestys">
        <option>lisäysten mukaan</option>
        <option>vaikeustason mukaan</option>
        <option>nimen mukaan</option>
      </select>
    </div>
  </form>
</section>
  
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

