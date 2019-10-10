<?php 
  require_once(__DIR__.'/Komponentit/Header/header.php'); 
  
  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }
  
  Headeri('Oma profiili');

  $kayttaja = Kayttajat::kayttaja($db,$kayttaja);
?>

<header>
  <h1 class='keskella'>Oma profiili</h1>
</header>

<form id='kayttajalomake' class='keskita' 
    action='./Api/kayttajat.php' method='POST'
    enctype='multipart/form-data'>
  
  <input type='hidden' name='kayttajatunnus' id='kayttajatunnus' value=<?=$kayttaja->kayttajatunnus?>>

  <div>
    <label for='etunimi'>Etunimi</label>
    <input type='text' name='etunimi' id='etunimi' 
      placeholder='Jane' value=<?=$kayttaja->etunimi?>>
  </div>

  <div>
    <label for='sukunimi'>Sukunimi</label>
    <input type='text' name='sukunimi' id='sukunimi' 
      placeholder='Doe' value=<?=$kayttaja->sukunimi?>>
  </div>

  <div>
    <label for='kuva'>Profiilikuva</label>
    <input type='file' name='kuva' id='kuva'>
    <?php if (isset($kayttaja->kuva)): ?>
      <img alt=<?= $kayttaja->kayttajatunnus; ?> src=<?= $kayttaja->kuva ?>>
    <?php endif; ?>
  </div>

  <div>
    <label for='kuvaus'>Kuvaus</label>
    <textarea name='kuvaus' id='kuvaus' cols='30' rows='10' 
      placeholder='Kuvaus itsestäsi...'><?=$kayttaja->kuvaus?></textarea>
  </div>

  <div>
    <button class='nappi-p' type='submit'>Tallenna</button>
    <a class='nappi nappi-s' href='index_kirjautunut.php'>Peruuta</a>
  </div>
</form>

<script src='./Scripts/profiili.js'></script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
