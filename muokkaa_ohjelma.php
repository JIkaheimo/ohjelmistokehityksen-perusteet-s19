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

  $ohjelmaID = $_GET['id'];

  // TODO: Tähän ohjelman, harjoitusten ja vaiheiden haku tietokannasta.
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Muokkaa ohjelmaa');
?>

<header>
  <h1 class="keskella">Muokkaa ohjelmaa</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form class="keskita" action="./Api/muokkaa_ohjelma.php" method="POST">
  <input type="hidden" name="ohjelma-id" id="ohjelma-id" value="123" />
  <div>
    <label for="ohjelma-nimi">Ohjelman nimi</label>
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
  <button type="submit" class="nappi-p">Päivitä tiedot</button>
  <a href="ohjelmani.php" class="nappi nappi-s">Peruuta</a>
</form>

<form
  class="valia keskita"
  action="./Api/uusi_harjoitus.php"
  method="POST"
>
  <div>
    <label for="uusi-harjoitus">Harjoituksen nimi</label>
    <input type="text" name="uusi-harjoitus" id="uusi-harjoitus" />
  </div>
  <button type="submit" class="nappi-p">Lisää harjoitus +</button>
</form>

<section class="keskita">
  <header>
    <h2 class="keskella">Harjoitukset</h2>
  </header>

  <div class="sailio keskita">
    <section class="harjoitus-section">
      <img class="keskita" src="./Assets/barbell.png" alt="harjoitus" />
      <div>
        <header>
          <h3 class="keskella">Vatsa</h3>
        </header>

        <a class="nappi nappi-p" href="muokkaa_harjoitus.php?id=1"
          >Muokkaa</a
        >

        <form action="./Api/poista_harjoitus.php">
          <input type="hidden" name="harjoitus-id" value="123" />
          <button class="nappi-s" type="submit">Poista x</button>
        </form>
      </div>
    </section>

    <section class="harjoitus-section">
      <img class="keskita" src="./Assets/barbell.png" alt="harjoitus" />
      <div>
        <header>
          <h3 class="keskella">Selkä/Hauis</h3>
        </header>

        <a class="nappi nappi-p" href="muokkaa_harjoitus.php?id=2"
          >Muokkaa</a
        >

        <form action="./Api/poista_harjoitus.php">
          <input type="hidden" name="harjoitus-id" value="123" />
          <button class="nappi-s" type="submit">Poista x</button>
        </form>
      </div>
    </section>

    <section class="harjoitus-section">
      <img class="keskita" src="./Assets/barbell.png" alt="harjoitus" />
      <div>
        <header>
          <h3 class="keskella">Jalat/Olkapäät</h3>
        </header>

        <a class="nappi nappi-p" href="muokkaa_harjoitus.php?id=3"
          >Muokkaa</a
        >

        <form action="./Api/poista_harjoitus.php">
          <input type="hidden" name="harjoitus-id" value="123" />
          <button class="nappi-s" type="submit">Poista x</button>
        </form>
      </div>
    </section>

    <section class="harjoitus-section">
      <img class="keskita" src="./Assets/barbell.png" alt="harjoitus" />
      <div>
        <header>
          <h3 class="keskella">Rinta/Ojentajat</h3>
        </header>

        <a class="nappi nappi-p" href="muokkaa_harjoitus.php?id=4"
          >Muokkaa</a
        >

        <form action="./Api/poista_harjoitus.php">
          <input type="hidden" name="harjoitus-id" value="123" />
          <button class="nappi-s" type="submit">Poista x</button>
        </form>
      </div>
    </section>
  </div>
</section>
  
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

