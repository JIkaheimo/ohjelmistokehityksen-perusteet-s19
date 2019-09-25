<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Hallintapaneeli | REENIKIRJA</title>
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
        <!-- TODO: Käyttäjän nimi tietokannasta -->
        <h1>Testaaja123 hallintapaneeli</h1>
      </header>

      <!-- OMAT OHJELMAT -->
      <section>
        <header>
          <h2>Omat ohjelmat</h2>
          <a class="nappi nappi-p" href="ohjelmani.php">Hallinnoi</a>
        </header>

        <!-- TODO: Listan täyttö tietokannasta, käyttäjän omilla ohjelmilla -->
        <ul>
          <li><a href="ohjelma.php?id=1">Kesäkuntoon 2050</a></li>
          <li>
            <a href="ohjelma.php?id=2"
              >3-jakoinen kuntosaliohjelma aloittelijoille</a
            >
          </li>
          <li>
            <a href="ohjelma.php?id=3"
              >4-jakoinen kuntosaliohjelma edistyneille</a
            >
          </li>
          <li><a href="ohjelma.php?id=4">Joulukuntoon 2030</a></li>
          <li><a href="ohjelma.php?id=5">Yleisurheilulla yleiskuntoon</a></li>
        </ul>
      </section>
      <!-- END OMAT OHJELMAT -->

      <!-- VIIMEAIKAISET SUORITUKSET -->
      <section>
        <header>
          <h2>Viimeaikaiset suoritukset</h2>
          <a class="nappi nappi-p" href="suoritukset.php">Hallinnoi</a>
        </header>

        <table>
          <thead>
            <tr>
              <th>Päivämäärä</th>
              <th>Harjoitus</th>
              <th>Ohjelma</th>
              <th>Kesto (min)</th>
            </tr>
          </thead>
          <!-- TODO: Taulukon bodyn täyttö tietokannasta haetuista suorituksilla (5 viimeisintä) -->
          <tbody>
            <tr class="suoritus-tr">
              <th>21.09.2019</th>
              <td>Rinta/ojentajat</td>
              <td>
                <a href="ohjelma.php?id=12"
                  >4-jakoinen kuntosaliohjelma edistyneille</a
                >
              </td>
              <td>72</td>
            </tr>

            <tr class="suoritus-tr">
              <th>18.09.2019</th>
              <td>Juoksulenkki</td>
              <td><a href="ohjelma.php?id=12">Kesäkuntoon 2050</a></td>
              <td>63</td>
            </tr>

            <tr class="suoritus-tr">
              <th>15.09.2019</th>
              <td>Juoksulenkki</td>
              <td>
                <a href="ohjelma.php?id=12">Yleisurheilulla yleiskuntoon</a>
              </td>
              <td>63</td>
            </tr>

            <tr class="suoritus-tr">
              <th>13.09.2019</th>
              <td>Juoksulenkki</td>
              <td>
                <a href="ohjelma.php?id=12"
                  >4-jakoinen kuntosaliohjelma edistyneille</a
                >
              </td>
              <td>63</td>
            </tr>

            <tr class="suoritus-tr">
              <th>11.09.2019</th>
              <td>Juoksulenkki</td>
              <td><a href="ohjelma.php?id=12">Kesäkutnoon 2050</a></td>
              <td>63</td>
            </tr>
          </tbody>
        </table>
      </section>
      <!-- END VIIMEAIKAISET SUORITUKSET -->
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
