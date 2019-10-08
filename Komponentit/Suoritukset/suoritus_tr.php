<?php function SuoritusTR($suoritus) { ?>

<tr class='suoritus-tr' id='suoritus-<?= $suoritus->suoritusId; ?>'>
  <th><?= $suoritus->suoritusPvm; ?></th>
  <td><?= htmlspecialchars($suoritus->harjoitus) ?: 'HARJOITUS POISTETTU'?></td>
  <td><a href='ohjelma.php?id=<?= $suoritus->ohjelmaId; ?>'><?= htmlspecialchars($suoritus->ohjelma); ?></a></td>
  <td><?=$suoritus->kesto?></td>

  <td>
    <div class='sailio'>
      <a class='nappi nappi-p' href='muokkaa_suoritus.php?id=<?= $suoritus->suoritusId; ?>'>Muokkaa</a>
      <form data-id=<?= $suoritus->suoritusId; ?> class='poista-suoritus'>
        <button class='nappi-s' type='submit'>Poista X</button>
      </form>
    </div>
  </td>

</tr>

<?php } ?>
