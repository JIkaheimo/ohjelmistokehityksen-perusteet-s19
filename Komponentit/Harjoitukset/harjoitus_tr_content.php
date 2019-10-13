<?php function HarjoitusTRContent ($harjoitus, $kontrollit = true) { ?>

  <td><?= htmlspecialchars($harjoitus->nimi); ?></td>

  <?php if ($kontrollit): ?>
    <td>
      <div class='sailio flex-oikea'>

        <!-- Linkki harjoituksen muokkaukseen -->
        <a class='nappi nappi-m' href='muokkaa_harjoitus.php?id=<?= $harjoitus->harjoitusId; ?>'>
          <i class='material-icons'>
          edit
          </i>
        </a>
        <!-- EMD (Linkki harjoituksen muoukkaukseen) -->

        <!-- Harjoituksen poistolomake -->
        <form
          id='poista-harjoitus-<?= $harjoitus->harjoitusId; ?>' 
          data-id=<?= $harjoitus->harjoitusId; ?> 
          class='poista-harjoitus-lomake'
        >
          <button class='nappi-d' type='submit'>
            <i class='material-icons'>
              delete_forever
            </i>
          </button>
        </form> 
        <!-- END (Harjoituksen poistolomake) -->
      
      </div>
    </td>
  <?php endif; ?>



<?php } ?>