<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ohjelmat | REENIKIRJA</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>

  <body>
    <header class="flex">
      <nav class="kapea">
        <a href="index_kirjautunut.php">REENIKIRJA</a>
        <ul>
          <li><a class="valittu" href="ohjelmat.php">Ohjelmat</a></li>
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