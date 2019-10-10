<?php function KayttajaSection(stdClass $kayttaja) { 
  $ktunnus = htmlspecialchars($kayttaja->kayttajatunnus);
  
?>

  <section class='kayttaja'>
    <a href='kayttaja.php?id=<?=$ktunnus?>'>
      <img class='img' src=<?= './Assets/Kayttajat/' . $kayttaja->kuva ?: 'kayttaja-placeholder.png'?> alt=<?= $ktunnus ?> />
      <div>
        <h3><?=$ktunnus?></h3>
      </div>
    </a>
  </section>

<?php } ?>

