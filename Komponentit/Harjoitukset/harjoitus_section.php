<?php function HarjoitusSection($nimi, $id) { ?>

  <section class="harjoitus-section">
    <img class="keskita" src="./Assets/barbell.png" alt="harjoitus" />
    <div>
      <header>
        <h3 class="keskella"><?=$nimi?></h3>
      </header>

      <a class="nappi nappi-p" href="muokkaa_harjoitus.php?id=<?=$id?>">Muokkaa</a>

      <form action="./Api/poista_harjoitus.php">
        <input type="hidden" name="harjoitus-id" value="123">
        <button class="nappi-s" type="submit">Poista x</button>
      </form>
    </div>
  </section>

<?php } ?>
