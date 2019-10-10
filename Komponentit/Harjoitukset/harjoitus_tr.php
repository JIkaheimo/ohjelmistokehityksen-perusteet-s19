<?php function HarjoitusTR($harjoitus, $kontrollit = true) { 
    
?>

  <tr id='harjoitus-<?= $harjoitus->harjoitusId; ?>' class='harjoitus-tr'>
    <td><?= htmlspecialchars($harjoitus->nimi); ?></td>

    <?php if ($kontrollit): ?>
      <td>
        <div class='sailio flex-oikea'>
          <a class='nappi nappi-p' href='muokkaa_harjoitus.php?id=<?= $harjoitus->harjoitusId; ?>'>
            <i class="material-icons">
            edit
            </i>
          </a>
          <form data-id=<?= $harjoitus->harjoitusId; ?> class='poista-harjoitus-lomake'>
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
