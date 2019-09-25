<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Suoritus 21.09.2019');
?>

<header>
  <h1 class="keskella">Muokkaa suoritusta</h1>
</header>

<form class="keskita" action="./Api/muokkaa_suoritus.php" method="POST">
  <!-- PÄIVÄYKSEN VALINTA -->
  <div>
    <label for="paivays">Päiväys:</label>
    <input type="date" name="paivays" id="paivays" required="" />
  </div>

  <!-- OHJELMAN VALINTA -->
  <div>
    <label for="reeniohjelma">Reeniohjelma:</label>
    <select name="reeniohjelma" id="reeniohjelma">
      <option>Kesäkuntoon 2050</option>
      <option>3-jakoinen kuntosaliohjelma aloittelijoille</option>
      <option>4-jakoinen kuntosaliohjelma edistyneille</option>
      <option>Joulukuntoon 2030</option>
      <option>Yleisurheilulla yleiskuntoon</option>
    </select>
  </div>

  <!-- HARJOITUKSEN VALINTA -->
  <div>
    <label for="harjoitus">Harjoitus:</label>
    <select name="harjoitus" id="harjoitus">
      <option>Juoksulenkki (pitkä)</option>
      <option>Juoksulenkki (lyhyt)</option>
      <option>Kuntosali</option>
      <option>Jalkapallo kavereiden kanssa</option>
      <option>Pikauinti</option>
    </select>
  </div>

  <!-- KESTON VALINTA -->
  <div>
    <label for="kesto">Kesto:</label>
    <input
      type="number"
      name="kesto"
      id="kesto"
      placeholder="60"
      required=""
    />
  </div>

  <!-- "ACTION"-NAPIT -->
  <button class="nappi-p" type="submit">Tallenna</button>
  <a class="nappi nappi-s" href="suoritukset.php">Peruuta</a>
</form>
    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>