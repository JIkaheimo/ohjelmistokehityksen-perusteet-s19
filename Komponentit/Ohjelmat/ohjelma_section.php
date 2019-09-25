<?php function OhjelmaSection($nimi, $kuva, $vaikeustaso, $id) { 
  if ($kuva == null) {
    $kuva = 'https://www.placehold.it/300x200/200';
  }  
?>

<section class="ohjelma">
  <img class="img img-kehys" src="<?=$kuva?>" alt="<?=$nimi?>" />
  <div>
    <h3><?=$nimi?></h3>
    <p><?=$vaikeustaso?></p>
    <a class="nappi nappi-p" href="ohjelma.php?id=<?=$id?>">Tarkastele</a>
  </div>
</section>

<?php } ?>


