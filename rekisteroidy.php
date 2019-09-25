<!DOCTYPE html>
<html lang="fi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Rekisteröidy | REENIKIRJA</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  </head>

  <body>
    <header>
      <nav class="kapea">
        <a href="index.php">REENIKIRJA</a>
        <form class="oikealle flex" action="./Api/kirjaudu.php" method="POST">
          <div>
            <label for="kayttajatunnus">Käyttäjätunnus:</label>
            <input
              type="text"
              name="kayttajatunnus"
              id="kayttajatunnus"
              required=""
            />
          </div>

          <div>
            <label for="salasana">Salasana:</label>
            <input type="password" name="salasana" id="salasana" required="" />
          </div>

          <button class="nappi-p" type="submit">Kirjaudu</button>
        </form>
      </nav>
    </header>

    <main class="kapea">
      <header>
        <h1 class="keskella">Rekisteröityminen</h1>
      </header>

      <form class="keskita" action="./Api/rekisteroidy.php">
        <div>
          <label for="rek-kayttajatunnus">Käyttäjätunnus</label>
          <input
            type="text"
            name="rek-kayttajatunnus"
            id="rek-kayttajatunnus"
            required=""
          />
        </div>
        <div>
          <label for="rek-salasana-1">Salasana</label>
          <input
            type="password"
            name="rek-salasana-1"
            id="rek-salasana-1"
            required=""
          />
        </div>
        <div>
          <label for="rek-salasana-2">Vahvista salasana</label>
          <input
            type="password"
            name="rek-salasana-2"
            id="rek-salasana-2"
            required=""
          />
        </div>

        <div>
          <button class="nappi-p" type="submit">Rekisteröidy</button>
          <a class="nappi nappi-s" href="index.php">Takaisin</a>
        </div>
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