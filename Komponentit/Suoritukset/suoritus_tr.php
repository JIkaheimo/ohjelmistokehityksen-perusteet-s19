<?php function SuoritusTR($paivays, $harjoitus, $ohjelma, $kesto, $id, $kontrollit=true) { ?>

<tr class="suoritus-tr">
  <th><?=$paivays?></th>
  <td><?=$harjoitus?></td>
  <td><a href="ohjelma.php?id=12"><?=$ohjelma?></a></td>
  <td><?=$kesto?></td>
  
  <?php if ($kontrollit) { ?>
    <td>
      <div class="sailio">
        <a class="nappi nappi-p" href="muokkaa_suoritus.php?id=<?=$id?>">Muokkaa</a>
        <form action="./Api/poista_suoritus.php" method="POST">
          <input type="hidden" id=<?=$id?> name="suoritus" value="<?=$id?>" />
          <button class="nappi-s" type="submit">Poista X</button>
        </form>
      </div>
    </td>
  <?php } ?>

</tr>

<?php } ?>
