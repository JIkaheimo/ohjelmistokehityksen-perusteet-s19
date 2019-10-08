<?php 

// Komponentit
require_once(__DIR__.'/Komponentit/Header/header.php'); 
require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_tr.php');

// Varmistetaan että käyttäjä on kirjautunut
if ($kayttaja == null)
{
  header('Location: 401.php');
}

Headeri('Lisätyt ohjelmat');

$ohjelmat = Ohjelmat::haeKayttajanLisaamat($db, $kayttaja);
print_r($ohjelmat);

?>

<header>
  <h1>Lisätyt ohjelmat</h1>
</header>

<?php if (!empty($ohjelmat)): ?>
  <!-- Tulostetaan käyttäjän ohjelmat jos niitä on -->
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
        foreach ($ohjelmat as $ohjelma) { 
          OhjelmaTR($ohjelma);
        } 
      ?>
    </tbody>
  </table>

<?php else: ?>
  <!-- Tulostetaan ohje jos käyttäjällä ei ole ohjelmia -->
  
  <p>Et ole lisännyt vielä ohjelmia. :(</p>
<?php endif; ?>

<script src='./Scripts/ohjelmani.js'></script>
  
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

