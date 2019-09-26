<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Hallintapaneeli');
?>

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
    <li><a href="ohjelma.php?id=2">3-jakoinen kuntosaliohjelma aloittelijoille</a></li>
    <li><a href="ohjelma.php?id=3">4-jakoinen kuntosaliohjelma edistyneille</a></li>
    <li><a href="ohjelma.php?id=4">Joulukuntoon 2030</a></li>
    <li><a href="ohjelma.php?id=5">Yleisurheilulla yleiskuntoon</a></li>
  </ul>
</section> <!-- END OMAT OHJELMAT -->

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
      <?php 
        require_once(__DIR__.'/Komponentit/Suoritukset/suoritus_tr_pieni.php');

        SuoritusTRPieni('21.09.2019', 'Rinta/ojentajat', '4-jakoinen kuntosaliohjelma edistyneille', 72, 12);
        SuoritusTRPieni('18.09.2019', 'Juoksulenkki', 'Kesäkuntoon 2050', 63, 16); 
        SuoritusTRPieni('15.09.2019', 'Juoksulenkki', 'Yleisurheilulla yleiskuntoon', 63, 15); 
        SuoritusTRPieni('13.09.2019', 'Juoksulenkki', '4-jakoinen kuntosaliohjelma edistyneille', 63, 90); 
        SuoritusTRPieni('11.09.2019', 'Juoksulenkki', 'Kesäkutnoon 2050', 63, 7); 
      ?>
    </tbody>
  </table>
</section> <!-- END VIIMEAIKAISET SUORITUKSET -->

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
