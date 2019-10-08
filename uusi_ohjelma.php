<?php 

  require_once(__DIR__.'/Komponentit/Header/header.php');
  
  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }
  
  Headeri('Uusi ohjelma');

  $vaikeustasot = Vaikeustasot::hae($db);
?>

<header>
  <h1 class='keskella'>Uusi ohjelma</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form id='ohjelma-lomake' class='keskita'>
  
  <input type='hidden' name='kayttaja' 
    id='ohjelma-kayttaja' value=<?= $kayttaja; ?> 
  />   
  
  <div>
    <label for='ohjelma-nimi'>Nimi</label>
    <input type='text' name='nimi' 
      id='ohjelma-nimi' placeholder='Reeniohjelma' 
    />
  </div>

  <div>
    <label for='ohjelma-vaikeus'>Vaikeustaso</label>
    <select name='vaikeus' id='ohjelma-vaikeus'>
      <?php foreach ($vaikeustasot as $vaikeustaso) { ?>
        <option value=<?=$vaikeustaso->vaikeustasoId?>>
          <?= $vaikeustaso->nimi; ?>
        </option>
      <?php } ?>
    </select>
  </div>
  
  <button type='submit' class='nappi-p'>Luo ohjelma</button>
</form>

<script src='./Scripts/uusi_ohjelma.js'></script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

