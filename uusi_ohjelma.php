<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Uusi ohjelma | REENIKIRJA</title>
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
        <h1 class="keskella">Uusi ohjelma</h1>
      </header>

      <!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
      <form class="keskita" action="./Api/uusi_ohjelma.php" method="POST">
        <div>
          <label for="ohjelma-nimi">Nimi</label>
          <input
            type="text"
            name="ohjelma-nimi"
            id="ohjelma-nimi"
            value="4-jakoinen saliohjelma edistyneille"
          />
        </div>
        <div>
          <label for="ohjelma-vaikeus">Vaikeustaso</label>
          <select name="ohjelma-vaikeus" id="ohjelma-vaikeus">
            <option>Aloittelija</option>
            <option>Helppo</option>
            <option>Haastava</option>
            <option>Vaikea</option>
            <option>Extreme</option>
          </select>
        </div>
        <button type="submit" class="nappi-p">Luo ohjelma</button>
      </form>
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