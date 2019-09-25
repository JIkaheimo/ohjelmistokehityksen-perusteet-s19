<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Testaaja123 | REENIKIRJA</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>

  <body>
    <header class="flex">
      <nav class="kapea">
        <a href="index_kirjautunut.php">REENIKIRJA</a>
        <ul>
          <li><a class="ei-valittu" href="ohjelmat.php">Ohjelmat</a></li>
          <li><a class="ei-valittu" href="suoritukset.php">Suoritukset</a></li>
          <li><a class="ei-valittu" href="kayttajat.php">Käyttäjät</a></li>
          <li class="oikealle">
            <a class="ei-valittu" href="profiili.php">Profiili</a>
          </li>
          <li><a href="./Api/uloskirjaudu.php">Kirjaudu ulos</a></li>
        </ul>
      </nav>
    </header>

    <main class="kapea">
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
    </main>

    <footer>
      <div>
        <p>© REENIKIRJA 2019</p>
        <p>
          Sivuston toteutus ja ylläpito:
          <a href="https://github.com/JIkaheimo">Jaakko Ikäheimo</a>
        </p>
      </div>
    </footer>
  </body>
</html>