<?php function OhjelmaTR($ohjelma, $kontrollit = true) { 
    
?>

  <tr id='ohjelma-<?= $ohjelma->ohjelmaId; ?>' class='ohjelma-tr'>
    <th><a href="ohjelma.php?id=<?= $ohjelma->ohjelmaId; ?>"><?= htmlspecialchars($ohjelma->nimi); ?></a></th>
    <td><?= $ohjelma->harjoituksia; ?></td>
    <td><?= $ohjelma->vaikeustaso; ?></td>

    <?php if ($kontrollit): ?>
      <td>
        <div class='sailio flex-oikea'>
          <a class='nappi nappi-p' href='muokkaa_ohjelma.php?id=<?= $ohjelma->ohjelmaId; ?>'>
            <i class="material-icons">
            edit
            </i>
          </a>
          <form data-id=<?= $ohjelma->ohjelmaId; ?> class='poista-ohjelma-lomake'>
            <input type='hidden' name='id' id='ohjelma-<?= $ohjelma->ohjelmaId; ?>' value=<?= $ohjelma->ohjelmaId; ?>>
            <button class='nappi-r' type='submit'>
              <i class="material-icons">
                delete_forever
              </i>
            </button>
          </form>
        </div>
      </td>
    <?php endif; ?>
  </tr>


<?php } ?>
