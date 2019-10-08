<?php function OhjelmaTR($ohjelma) { 
    
?>

  <tr id='ohjelma-<?= $ohjelma->ohjelmaId; ?>' class='ohjelma-tr'>
    <th><?= htmlspecialchars($ohjelma->nimi); ?></th>
    <td><?= $ohjelma->harjoituksia; ?></td>
    <td><?= $ohjelma->vaikeustaso; ?></td>

    <td>
      <div class='sailio'>
        <a class='nappi nappi-p' href='muokkaa_ohjelma.php?id=<?= $ohjelma->ohjelmaId; ?>'>Muokkaa</a>
        <form data-id=<?= $ohjelma->ohjelmaId; ?> class='poista-ohjelma-lomake'>
          <input type='hidden' name='id' id='ohjelma-<?= $ohjelma->ohjelmaId; ?>' value=<?= $ohjelma->ohjelmaId; ?>>
          <button class='nappi-r' type='submit'>Poista x</button>
        </form>
      </div>
    </td>
  </tr>


<?php } ?>
