<?php 
  if (!isset($_GET['id'])) {
    header('Location: 404.php');
  }
  
  // TODO: Tähän kirjautumisen varmistus.

  $kayttajaID = $_GET['id'];

  // TODO: Tähän käyttäjän tietojen ja ohjelmien haku.

  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Testaaja123');
?>

<header>
  <h1>Testaaja123</h1>
  <form action="./Api/lisaa_seuraus.php" method="POST">
    <input type="hidden" name="kayttaja-id" id="kayttaja-id" value="2" />
    <button type="submit" class="nappi-p">Seuraa +</button>
  </form>
</header>

<img
  class="img img-kehys"
  src="https://www.placehold.it/400x400/200"
  alt="kayttajanimi"
/>
<section>
  <header>
    <h2>Kuvaus</h2>
  </header>
  <p>
    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec
    quam et mi rhoncus gravida. Sed vitae purus nec nulla volutpat gravida
    vestibulum a purus. Quisque ac consectetur ligula, in hendrerit est.
    Proin scelerisque pharetra dolor, quis dictum metus tincidunt
    eleifend. Vivamus vel facilisis diam. Nulla eu nibh non nunc luctus
    sodales non et tortor. Ut fringilla pulvinar mollis. Quisque ac
    euismod massa. Sed vel sagittis felis. Curabitur ligula leo, elementum
    et ex ac, dapibus laoreet sapien. Sed eget arcu lacinia, vestibulum
    nulla non, rhoncus lacus. Fusce dictum malesuada sapien non sagittis.
    Maecenas blandit leo sit amet ante auctor, id interdum purus
    fringilla. Curabitur auctor porta ipsum id imperdiet. Proin bibendum
    odio eget urna venenatis, in laoreet ipsum tincidunt.
  </p>
</section>

<section>
  <header>
    <h2>Käyttäjän ohjelmat</h2>
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


<?php
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>




