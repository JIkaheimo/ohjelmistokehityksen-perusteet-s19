<?php function KayttajaSection(stdClass $kayttaja) { 
  $ktunnus = htmlspecialchars($kayttaja->kayttajatunnus);
  
?>

  <section class='kayttaja' id='<?= $ktunnus ?>'>
    <a href='kayttaja.php?id=<?=$ktunnus?>'>
      <img class='img' src=<?= './Assets/Kayttajat/' . $kayttaja->kuva ?: 'kayttaja-placeholder.png'?> alt='<?= $ktunnus ?>' />
      <div>
        <h3><?= htmlspecialchars($ktunnus); ?></h3>
      </div>
    </a>
  </section>

<?php } ?>

