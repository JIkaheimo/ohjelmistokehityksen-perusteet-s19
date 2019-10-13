<?php 
  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  Headeri('Uusi suoritus');

  // Varmistetaan että käyttäjällä on ohjelmia
  $ohjelmat = Ohjelmat::haeKayttajanHarjoitukselliset($db, $kayttaja);
  
?>

<header>
  <h1 class='keskella'>Lisää suoritus</h1>
</header>

<?php if (empty($ohjelmat)) : ?>

  <div class="keskella">
  <p>Luo tai lisää ohjelma harjoituksella lisätäksesi suoritus...</p>
  <a href="ohjelmani.php" class="nappi nappi-p">Luo ohjelma</a>
  <a href="ohjelmat.php" class="nappi nappi-p">Selaa ohjelmia</a>
  </div>

<?php else: 
  $harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelmat[0]->ohjelmaId);
?>

  <form id='suorituslomake' class='keskita'>

    <input type='hidden' name='kayttaja' 
      id='kayttaja' value='<?= $kayttaja; ?>'
    />

    <!-- PÄIVÄYKSEN VALINTA -->
    <div>
      <label for='paivays'>Päiväys</label>
      <input type='date' name='paivays' id='paivays' required>
    </div>

    <!-- OHJELMAN VALINTA -->
    <div>
      <label for='ohjelma'>Reeniohjelma</label>
      <select name='ohjelma' id='ohjelma'>   
        <?php foreach ($ohjelmat as $ohjelma) : ?>
          <option value=<?= $ohjelma->ohjelmaId; ?>>
            <?= htmlspecialchars($ohjelma->nimi); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- HARJOITUKSEN VALINTA -->
    <div>
      <label for='harjoitus'>Harjoitus</label>
      <select name='harjoitus' id='harjoitus'>   
        <?php foreach ($harjoitukset as $harjoitus) : ?>
          <option value=<?= $harjoitus->harjoitusId; ?>>
            <?= htmlspecialchars($harjoitus->nimi); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- KESTON VALINTA -->
    <div>
      <label for='kesto'>Kesto (min)</label>
      <input type='number' name='kesto' id='kesto' placeholder=60 required>
    </div>

    <!-- 'ACTION'-NAPIT -->
    <button class='nappi-p' type='submit' name='submit'>Tallenna</button>
    <a class='nappi nappi-s' href='suoritukset.php'>Peruuta</a>
  </form>


  <script src='./Scripts/suoritus.js'></script>

<?php endif; ?>


<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>