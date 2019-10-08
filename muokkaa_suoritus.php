<?php 
  if (!isset($_GET['id']) || $_GET['id'] == null)
  {
    header('Location: 404.php');
  }
  
  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  Headeri('Muokkaa suoritusta');

  // Varmistetaan että käyttäjällä on ohjelmia
  $ohjelmat = Ohjelmat::haeKayttajanHarjoitukselliset($db, $kayttaja);
  if (empty($ohjelmat))
  {
    echo('<p>Luo tai lisää ohjelma harjoituksella muokataksesi suoritusta...</p>');
    exit;
  }

  $harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelmat[0]->ohjelmaId);
  $suoritus = Suoritukset::hae($db, $_GET['id']);
?>

<header>
  <h1 class='keskella'>Muokkaa suoritusta</h1>
</header>

<form id='suorituslomake' class='keskita'>

  <input type='hidden' name='kayttaja' id='kayttaja' value=<?=$kayttaja?>>
  <input type='hidden' name='suoritus' id='suoritus' value=<?=$_GET['id']?>>

  <!-- PÄIVÄYKSEN VALINTA -->
  <div>
    <label for='paivays'>Päiväys:</label>
    <input type='date' name='paivays' id='paivays' value=<?=$suoritus->suoritusPvm?> required>
  </div>

  <!-- OHJELMAN VALINTA -->
  <div>
    <label for='ohjelma'>Reeniohjelma:</label>
    <select name='ohjelma' id='ohjelma'>   
      <?php foreach ($ohjelmat as $ohjelma) { ?>
        <option value='<?=$ohjelma->ohjelmaId?>'><?=$ohjelma->nimi?></option>
      <?php } ?>
    </select>
  </div>

  <!-- HARJOITUKSEN VALINTA -->
  <div>
    <label for='harjoitus'>Harjoitus:</label>
    <select name='harjoitus' id='harjoitus'>   
      <?php foreach ($harjoitukset as $harjoitus) { ?>
        <option value='<?=$harjoitus->harjoitusId?>'><?=$harjoitus->nimi?></option>
      <?php } ?>
    </select>
  </div>

  <!-- KESTON VALINTA -->
  <div>
    <label for='kesto'>Kesto:</label>
    <input type='number' name='kesto' id='kesto' placeholder=60 value=<?=$suoritus->kesto?> required>
  </div>

  <!-- 'ACTION'-NAPIT -->
  <button class='nappi-p' type='submit' name='submit'>Tallenna</button>
  <a class='nappi nappi-s' href='suoritukset.php'>Peruuta</a>
</form>



<script src='./Scripts/suoritus.js'></script>
<script>asetaPyynto('put');</script>

    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>