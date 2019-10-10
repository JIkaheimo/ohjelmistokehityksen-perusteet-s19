<?php function VaiheTR($vaihe, $kontrollit = false) { ?>

  <tr class='vaihe-tr'>

    <th>
      <?= $vaihe->nimi; ?>
    </th>
    
    <td>
      <?= $vaihe->kuvaus; ?>
    </td>
    
    <td>
      <?php if ($vaihe->ohjelinkki != null) { ?>
        <a href='<?= $vaihe->ohjelinkki; ?>'>Linkki</a>
      <?php } ?>
    </td>

    <?php if ($kontrollit) { ?>
      <td>
        <div class='sailio'>
          <a class='nappi nappi-p' href='muokkaa_vaihe.php?id=<?= $vaihe->vaiheId; ?>'>
            <i class="material-icons">
              edit
            </i>
          </a>
          <form data-id=<?= $vaihe->vaiheId; ?>>
            <input type='hidden' name='id' 
                value=<?= $vaihe->vaiheId; ?> />
            <button type='submit'>
              <i class="material-icons">
                delete_forever
              </i>
            </button>
          </form>
        </div>
      </td>
    <?php } ?>

  </tr>

<?php } ?>