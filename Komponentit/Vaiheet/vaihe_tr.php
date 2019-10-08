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
          <a class='nappi nappi-p' href='muokkaa_vaihe.php?id=<?= $vaihe->vaiheId; ?>'>Muokkaa</a>
          <form action='./Api/poista_vaihe.php' method='POST'>
            <input type='hidden' name='id' id='vaihe-<?= $vaihe->vaiheId; ?>' value=<?= $vaihe->vaiheId; ?> />
            <button class='nappi-s' type='submit'>Poista x</button>
          </form>
        </div>
      </td>
    <?php } ?>

  </tr>

<?php } ?>