<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Suoritukset');
?>

<header>
  <h1>Suoritukset</h1>
  <a class="nappi nappi-p" href="uusi_suoritus.php">Uusi suoritus +</a>
</header>

<table>
  <thead>
    <tr>
      <th>Päiväys</th>
      <th>Harjoitus</th>
      <th>Reeniohjelma</th>
      <th>Kesto (min)</th>
      <th></th>
    </tr>
  </thead>
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

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=12"
            >Muokkaa</a
          >
          <form action="./Api/poista_suoritus.php" method="POST">
            <input type="hidden" id="12" name="suoritus" value="12" />
            <button class="nappi-s" type="submit">Poista X</button>
          </form>
        </div>
      </td>
    </tr>

    <tr class="suoritus-tr">
      <th>18.09.2019</th>
      <td>Juoksulenkki</td>
      <td><a href="ohjelma.php?id=12">Kesäkuntoon 2050</a></td>
      <td>63</td>

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=16"
            >Muokkaa</a
          >
          <form action="./Api/poista_suoritus.php" method="POST">
            <input type="hidden" id="16" name="suoritus" value="16" />
            <button class="nappi-s" type="submit">Poista X</button>
          </form>
        </div>
      </td>
    </tr>

    <tr class="suoritus-tr">
      <th>15.09.2019</th>
      <td>Juoksulenkki</td>
      <td>
        <a href="ohjelma.php?id=12">Yleisurheilulla yleiskuntoon</a>
      </td>
      <td>63</td>

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=15"
            >Muokkaa</a
          >
          <form action="./Api/poista_suoritus.php" method="POST">
            <input type="hidden" id="15" name="suoritus" value="15" />
            <button class="nappi-s" type="submit">Poista X</button>
          </form>
        </div>
      </td>
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

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=90"
            >Muokkaa</a
          >
          <form action="./Api/poista_suoritus.php" method="POST">
            <input type="hidden" id="90" name="suoritus" value="90" />
            <button class="nappi-s" type="submit">Poista X</button>
          </form>
        </div>
      </td>
    </tr>

    <tr class="suoritus-tr">
      <th>11.09.2019</th>
      <td>Juoksulenkki</td>
      <td><a href="ohjelma.php?id=12">Kesäkutnoon 2050</a></td>
      <td>63</td>

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=7"
            >Muokkaa</a
          >
          <form action="./Api/poista_suoritus.php" method="POST">
            <input type="hidden" id="7" name="suoritus" value="7" />
            <button class="nappi-s" type="submit">Poista X</button>
          </form>
        </div>
      </td>
    </tr>
  </tbody>
</table>

 <?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
