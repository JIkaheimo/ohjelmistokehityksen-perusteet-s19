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

    <?php
      require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_tr.php');
      OhjelmaTR('4-jakoinen saliohjelma edistyneille', 5, 'vaikea', 12);
      OhjelmaTR('4-jakoinen saliohjelma edistyneille', 4, 'helppo', 23);
      OhjelmaTR('4-jakoinen saliohjelma edistyneille', 3, 'aloittelija', 15);
      OhjelmaTR('24/7 treeniohjelma pähkähulluille', 20, 'extreme', 13);
    ?>

  </tbody>
</table>
    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>