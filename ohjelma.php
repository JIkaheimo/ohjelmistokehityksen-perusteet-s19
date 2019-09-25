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
        <h1>4-jakoinen kuntosaliohjelma aloittelijoille</h1>
        <form action="./Api/lisaa_ohjelma.php" method="POST">
          <input type="hidden" name="ohjelma-id" id="ohjelma-id" value="12" />
          <button type="submit" class="nappi-p">Lisää+</button>
        </form>
      </header>

      <p>Tekijä: <a href="kayttaja.php?id=123">Testaaja123</a></p>

      <section>
        <header>
          <h2>Vatsa</h2>
        </header>
        <table>
          <thead>
            <tr>
              <th>Vaihe</th>
              <th>Kuvaus</th>
              <th>Ohjelinkki</th>
            </tr>
          </thead>
          <tbody>
            <tr class="vaihe-tr">
              <th>Vatsalihaskone</th>
              <td>
                Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vino vatsalihaspenkki</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td>
                <a href="https://www.google.fi">Linkki</a>
              </td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Ilmapyörä</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Jalannosto</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Juoksu</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section>
        <header>
          <h2>Rinta/Ojentajat</h2>
        </header>
        <table>
          <thead>
            <tr>
              <th>Vaihe</th>
              <th>Kuvaus</th>
              <th>Ohjelinkki</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vatsalihaskone</th>
              <td>
                Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vino vatsalihaspenkki</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td>
                <a href="https://www.google.fi">Linkki</a>
              </td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Ilmapyörä</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Jalannosto</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Juoksu</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section>
        <header>
          <h2>Selkä/Hauis</h2>
        </header>
        <table>
          <thead>
            <tr>
              <th>Vaihe</th>
              <th>Kuvaus</th>
              <th>Ohjelinkki</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vatsalihaskone</th>
              <td>
                Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vino vatsalihaspenkki</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td>
                <a href="https://www.google.fi">Linkki</a>
              </td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Ilmapyörä</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Jalannosto</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Juoksu</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </section>

      <section>
        <header>
          <h2>Jalat/Olkapäät</h2>
        </header>
        <table>
          <thead>
            <tr>
              <th>Vaihe</th>
              <th>Kuvaus</th>
              <th>Ohjelinkki</th>
            </tr>
          </thead>
          <tbody>
            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vatsalihaskone</th>
              <td>
                Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Vino vatsalihaspenkki</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td>
                <a href="https://www.google.fi">Linkki</a>
              </td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Ilmapyörä</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Jalannosto</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Sed vitae purus nec nulla
                volutpat gravida vestibulum a purus. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>

            <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

            <tr class="vaihe-tr">
              <th>Juoksu</th>
              <td>
                Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
                ligula, in hendrerit est.
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
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
