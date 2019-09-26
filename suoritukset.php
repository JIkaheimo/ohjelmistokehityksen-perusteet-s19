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
    <?php
      // TODO: Hae suoritukset päivämäärän mukaan jäsrjestettynä tietokannasta
      require_once(__DIR__.'/Komponentit/Suoritukset/suoritus_tr.php');

      SuoritusTR('21.09.2019', 'Rinta/ojentajat', '4-jakoinen kuntosaliohjelma edistyneille', 72, 12);
      SuoritusTR('18.09.2019', 'Juoksulenkki', 'Kesäkuntoon 2050', 63, 16); 
      SuoritusTR('15.09.2019', 'Juoksulenkki', 'Yleisurheilulla yleiskuntoon', 63, 15); 
      SuoritusTR('13.09.2019', 'Juoksulenkki', '4-jakoinen kuntosaliohjelma edistyneille', 63, 90); 
      SuoritusTR('11.09.2019', 'Juoksulenkki', 'Kesäkutnoon 2050', 63, 7); 
    ?>
  </tbody>
</table>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>