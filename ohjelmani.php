<?php 

// Komponentit
require_once(__DIR__.'/Komponentit/Header/header.php'); 
require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_tr.php');

// Varmistetaan että käyttäjä on kirjautunut
if ($kayttaja == null)
{
  header('Location: 401.php');
}

Headeri('Ohjelmani');

$ohjelmat = Ohjelmat::haeKayttajan($db, $kayttaja);

?>

<header>
  <h1>Ohjelmani</h1>
  <a class='nappi nappi-p' href='uusi_ohjelma.php'>Uusi ohjelma +</a>
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
  
  <p>Aloita luomalla uusi ohjelma.</p>
<?php endif; ?>

<script src='./Scripts/ohjelmani.js'></script>
  
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

