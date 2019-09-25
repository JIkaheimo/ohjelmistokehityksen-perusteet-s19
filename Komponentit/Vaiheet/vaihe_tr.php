<?php function VaiheTR($nimi, $kuvaus, $ohjelinkki, $id, $kontrollit=true) { ?>
  <!-- TODO: Syötä erillisten parametrien sijasta koko vaihe... -->

  <tr class="vaihe-tr">
    <th><?=$nimi?></th>
    <td><?=$kuvaus?></td>
    <td>
      <?php if ($ohjelinkki != null) { ?>
        <a href="<?=$ohjelinkki?>">Linkki</a>
      <?php } ?>
    </td>
    

    <?php if ($kontrollit) { ?>
      <td>
        <div class="sailio">
          <a class="nappi nappi-p" href="muokkaa_vaihe.php?id=<?=$id?>">Muokkaa</a>
          <form action="./Api/poista_vaihe.php" method="POST">
            <input type="hidden" name="id" id="vaihe-<?=$id?>" value=<?=$id?> />
            <button class="nappi-s" type="submit">Poista x</button>
          </form>
        </div>
      </td>
    <?php } ?>

  </tr>

<?php } ?>