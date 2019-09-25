<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Käyttäjät | REENIKIRJA</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>

  <body>
    <header class="flex">
      <nav class="kapea">
        <a href="index_kirjautunut.php">REENIKIRJA</a>
        <ul>
          <li><a class="ei-valittu" href="ohjelmat.php">Ohjelmat</a></li>
          <li><a class="ei-valittu" href="suoritukset.php">Suoritukset</a></li>
          <li><a class="valittu" href="kayttajat.php">Käyttäjät</a></li>
          <li class="oikealle">
            <a class="ei-valittu" href="profiili.php">Profiili</a>
          </li>
          <li><a href="./Api/uloskirjaudu.php">Kirjaudu ulos</a></li>
        </ul>
      </nav>
    </header>

    <main class="kapea">
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
