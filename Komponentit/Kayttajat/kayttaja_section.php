<?php function KayttajaSection($kayttajatunnus, $kuva=null, $id) { 
  if ($kuva == null) {
    $kuva = 'https://www.placehold.it/300x200/200';
  }  
?>

<section class="kayttaja">
  <img class="img img-kehys" src=<?=$kuva?> alt=<?=$kayttajatunnus?> />
  <div>
    <h3><?=$kayttajatunnus?></h3>
    <a class="nappi nappi-p" href="kayttaja.php?id=<?=$id?>">Profiili</a>
  </div>
  </header>
</section>

<?php } ?>

