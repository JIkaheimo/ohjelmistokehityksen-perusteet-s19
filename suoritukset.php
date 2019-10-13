<?php 

require_once(__DIR__.'/Komponentit/Header/header.php'); 
require_once(__DIR__.'/Komponentit/Suoritukset/suoritus_tr.php');

if ($kayttaja == null)
{
  header('Location: 401.php');
}

Headeri('Suoritukset');

$suoritukset = Suoritukset::haeKayttajan($db, $kayttaja);    

?>

<header>
  <h1>Suoritukset</h1>
  <a class='nappi nappi-p' href='uusi_suoritus.php'>Uusi suoritus +</a>
</header>

<?php if ($suoritukset): ?>
  <!-- LISTA SUORITUKSISTA KUN SUORITUKSIA > 0 -->
  <table id='suoritustaulu'>
    <thead>
      <tr>
        <th>Päiväys</th>
        <th>Harjoitus</th>
        <th>Reeniohjelma</th>
        <th>Kesto (min)</th>
        <th></th>
      </tr>
    </thead>
    <tbody id='suoritukset'>
      <?php 
        foreach ($suoritukset as $suoritus) 
        {
          SuoritusTR($suoritus);
        } 
      ?>
    </tbody>
  </table>
<?php else: ?>
  <!-- APUTEKSTI KUN SUORITUKSIA == 0 -->
  <p>Aloita lisäämällä suoritus</p>
<?php endif; ?>

<script src='./Scripts/suoritukset.js'></script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>