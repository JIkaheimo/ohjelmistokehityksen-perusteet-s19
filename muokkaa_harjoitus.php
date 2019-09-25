<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }
  // TODO: Tähän kirjautumisen varmistus.
  /*
   if (!kirjautunut) {
     header('Loca)
   }
  */

  $harjoitusID = $_GET['id'];

  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Muokkaa harjoitusta');
?>
      
<header>
  <h1 class="keskella">Muokkaa harjoitusta</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form class="keskita" action="./Api/muokkaa_harjoitus.php" method="POST">
  <input type="hidden" name="harjoitus-id" id="harjoitus-id" value="2" />
  <div>
    <label for="harjoitus-nimi">Harjoituksen nimi</label>
    <input
      type="text"
      name="harjoitus-nimi"
      id="harjoitus-nimi"
      value="Vatsa"
    />
  </div>

  <button type="submit" class="nappi-p">Päivitä tiedot</button>
  <a href="muokkaa_ohjelma.php?id=123" class="nappi nappi-s">Peruuta</a>
</form>

<form class="valia keskita" action="./Api/uusi_vaihe.php" method="POST">
  <div>
    <label for="uusi-vaihe">Vaiheen nimi</label>
    <input type="text" name="uusi-vaihe" id="uusi-vaihe" />
  </div>
  <button type="submit" class="nappi-p">Lisää vaihe +</button>
</form>

<table>
  <thead>
    <tr>
      <th>Vaihe</th>
      <th>Kuvaus</th>
      <th>Ohjelinkki</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr class="vaihe-tr">
      <th>Vatsalihaskone</th>
      <td>
        Sed vitae purus nec nulla volutpat gravida vestibulum a purus.
      </td>
      <td></td>

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=1"
            >Muokkaa</a
          >
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-1" value="1" />
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
      </td>
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

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=2"
            >Muokkaa</a
          >
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-2" value="2" />
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
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

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=3"
            >Muokkaa</a
          >
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-3" value="3" />
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
      </td>
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

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=4"
            >Muokkaa</a
          >
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-4" value="4" />
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
      </td>
    </tr>

    <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

    <tr class="vaihe-tr">
      <th>Juoksu</th>
      <td>
        Nulla nec quam et mi rhoncus gravida. Quisque ac consectetur
        ligula, in hendrerit est.
      </td>
      <td></td>

      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=5"
            >Muokkaa</a
          >
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-5" value="5" />
            <button class="nappi-s" type="submit">Poista x</button>
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