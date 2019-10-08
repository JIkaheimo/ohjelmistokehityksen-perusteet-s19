<?php function KayttajaSection(stdClass $kayttaja) { 
  $ktunnus = htmlspecialchars($kayttaja->kayttajatunnus);
  
?>

  <section class='kayttaja'>
    <img class='img' src=<?= './Assets/Kayttajat/' . $kayttaja->kuva ?: 'kayttaja-placeholder.png'?> alt=<?= $ktunnus ?> />
    <div>
      <h3><?=$ktunnus?></h3>
      <a class='nappi nappi-p' href='kayttaja.php?id=<?=$ktunnus?>'>Profiili</a>
    </div>
  </section>

<?php } ?>

