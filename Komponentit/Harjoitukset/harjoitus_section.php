<?php function HarjoitusSection($harjoitus) { ?>

  <section id='<?= $harjoitus->harjoitusId; ?>' class='harjoitus keskita'>
    <img class='keskita img' src='./Assets/barbell.png' alt='harjoitus' />
    <div>
      <header>
        <h3 class='keskella'><?= htmlspecialchars($harjoitus->nimi); ?></h3>
      </header>

      <div class="controls">
          <a class='nappi nappi-p' href='muokkaa_harjoitus.php?id=<?= $harjoitus->harjoitusId; ?>'>Muokkaa</a>

          <form data-id=<?= $harjoitus->harjoitusId; ?> class='poista-harjoitus-form'>
            <input type='hidden' name='harjoitus' value=<?= $harjoitus->harjoitusId; ?>>
            <button class='nappi-s'>Poista x</button>
          </form>
      </div>
    </div>
  </section>

<?php } ?>
