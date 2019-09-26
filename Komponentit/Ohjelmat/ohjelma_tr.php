<?php function OhjelmaTR($nimi, $harjoitusLkm, $vaikeustaso, $id, $kontrollit = true) { ?>

  <tr class="ohjelma-tr">
    <th><?=$nimi?></th>
    <td><?=$harjoitusLkm?></td>
    <td><?=$vaikeustaso?></td>
  
    <?php if ($kontrollit) { ?>
      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_ohjelma.php?id=<?=$id?>">Muokkaa</a>
          <form action="./Api/poista_ohjelma.php">
            <input type="hidden" name="id" id="ohjelma-<?=$id?>" value=<?=$id?>>
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
      </td>
    <?php } ?>
  </tr>

<?php } ?>
