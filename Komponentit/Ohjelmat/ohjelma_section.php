<?php function OhjelmaSection(stdClass $ohjelma) { ?>

  <section class='ohjelma' id=<?= $ohjelma->ohjelmaId; ?> data-ohjelma='<?= $ohjelma->nimi; ?>'>
    <a href='ohjelma.php?id=<?= $ohjelma->ohjelmaId; ?>'>
      <img class='img' src=<?= './Assets/Ohjelmat/' . $ohjelma->kuva ?: 'ohjelma-placeholder.png'; ?> alt=<?= htmlspecialchars($ohjelma->nimi); ?> />
      <div>
        <h3><?= htmlspecialchars($ohjelma->nimi); ?></h3>
        <p><?= htmlspecialchars($ohjelma->vaikeustaso); ?></p>
      </div>
    </a>
  </section>

<?php } ?>


