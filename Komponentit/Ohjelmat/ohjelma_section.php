<?php function OhjelmaSection(stdClass $ohjelma) { ?>

  <section class='ohjelma'>
    <img class='img' src=<?= './Assets/Ohjelmat/' . $ohjelma->kuva ?: 'ohjelma-placeholder.png'; ?> alt=<?= htmlspecialchars($ohjelma->nimi); ?> />
    <div>
      <h3><?= htmlspecialchars($ohjelma->nimi); ?></h3>
      <p><?= $ohjelma->vaikeustaso; ?></p>
    </div>
    <a class='nappi nappi-p' href='ohjelma.php?id=<?= $ohjelma->ohjelmaId; ?>'>Tarkastele</a>
  </section>

<?php } ?>


