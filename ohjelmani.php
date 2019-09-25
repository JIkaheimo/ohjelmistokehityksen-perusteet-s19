<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Ohjelmani');
?>
      
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
    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>