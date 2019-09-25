<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Ohjelmani | REENIKIRJA</title>
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
        <h1>Ohjelmani</h1>
        <a class="nappi nappi-p" href="uusi_ohjelma.php">Uusi ohjelma +</a>
      </header>

      <table>
        <thead>
          <tr>
            <th>Nimi</th>
            <th>Harjoituksia</th>
            <th>Vaikeustaso</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr class="ohjelma-tr">
            <th>4-jakoinen saliohjelma edistyneille</th>
            <td>5</td>
            <td>vaikea</td>

            <td>
              <div class="sailio">
                <a class="nappi nappi-p" href="muokkaa_ohjelma.php?id=12"
                  >Muokkaa</a
                >
                <form action="./Api/poista_ohjelma.php">
                  <input type="hidden" name="id" id="ohjelma-12" value="12" />
                  <button class="nappi-s" type="submit">Poista x</button>
                </form>
              </div>
            </td>
          </tr>

          <tr class="ohjelma-tr">
            <th>4-jakoinen saliohjelma edistyneille</th>
            <td>4</td>
            <td>helppo</td>

            <td>
              <div class="sailio">
                <a class="nappi nappi-p" href="muokkaa_ohjelma.php?id=23"
                  >Muokkaa</a
                >
                <form action="./Api/poista_ohjelma.php">
                  <input type="hidden" name="id" id="ohjelma-23" value="23" />
                  <button class="nappi-s" type="submit">Poista x</button>
                </form>
              </div>
            </td>
          </tr>

          <tr class="ohjelma-tr">
            <th>4-jakoinen saliohjelma edistyneille</th>
            <td>3</td>
            <td>aloittelija</td>

            <td>
              <div class="sailio">
                <a class="nappi nappi-p" href="muokkaa_ohjelma.php?id=15"
                  >Muokkaa</a
                >
                <form action="./Api/poista_ohjelma.php">
                  <input type="hidden" name="id" id="ohjelma-15" value="15" />
                  <button class="nappi-s" type="submit">Poista x</button>
                </form>
              </div>
            </td>
          </tr>

          <tr class="ohjelma-tr">
            <th>24/7 treeniohjelma pähkähulluille</th>
            <td>20</td>
            <td>extreme</td>

            <td>
              <div class="sailio">
                <a class="nappi nappi-p" href="muokkaa_ohjelma.php?id=13"
                  >Muokkaa</a
                >
                <form action="./Api/poista_ohjelma.php">
                  <input type="hidden" name="id" id="ohjelma-13" value="13" />
                  <button class="nappi-s" type="submit">Poista x</button>
                </form>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
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