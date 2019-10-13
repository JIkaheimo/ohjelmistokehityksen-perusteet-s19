<?php 
  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }
  Headeri('Muokkaa vaihetta');

  $vaihe = Vaiheet::hae($db, $_GET['id']);

?>

<header>
  <h1 class='keskella'>Muokkaa vaihetta</h1>
</header>

<form class='keskita' id='muokkauslomake'>

  <input type="hidden" name="vaihe" 
    id="vaihe" value=<?= $vaihe->vaiheId; ?>
  />

  <div>
    <label for='nimi'>Nimi</label>
    <input type='text' name='nimi' 
      id='nimi' value='<?= $vaihe->nimi; ?>'
    />
  </div>

  <div>
    <label for='kuvaus'>Kuvaus:</label>
    <textarea
      name='kuvaus'
      id='kuvaus'
      cols='30'
      rows='10'><?= $vaihe->kuvaus; ?>
    </textarea>
  </div>

  <div>
    <label for='linkki'>Linkki:</label>
    <input
      type='text'
      name='linkki'
      id='linkki'
      value=<?= $vaihe->ohjelinkki; ?>
    />
  </div>

  <div>
    <button class='nappi-p' type='submit'>Tallenna</button>
    <a class='nappi nappi-s' href='muokkaa_harjoitus.php?id=<?= $vaihe->harjoitusId; ?>'
      >Peruuta</a
    >
  </div>
</form>

<script src='./Scripts/muokkaa_vaihe.js'></script>
    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
