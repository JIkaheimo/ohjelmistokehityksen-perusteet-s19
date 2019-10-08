<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }

  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  require_once(__DIR__.'/Komponentit/Harjoitukset/harjoitus_section.php');

  Headeri('Muokkaa ohjelmaa');

  $ohjelmaID = (int) $_GET['id'];

  $ohjelma = Ohjelmat::hae($db, $ohjelmaID);
  $harjoitukset = Harjoitukset::haeOhjelman($db, $ohjelma->ohjelmaId);
  $vaikeustasot = Vaikeustasot::hae($db);
?>


<!--==== OHJELMAN TIETOJEN MUOKKAUSLOMAKE ====-->
<header>
  <h1 class='keskella'>Muokkaa ohjelmaa</h1>
</header>

<form id='ohjelma-lomake' class='keskita'>

  <!-- Ohjelman ID -->
  <input type='hidden' name='id'
     id='ohjelma-id' value=<?= $ohjelma->ohjelmaId; ?>
  />
  
  <!-- Ohjelman käyttäjä -->
  <input type='hidden' name='kayttaja' 
    id='ohjelma-kayttaja' value=<?= htmlspecialchars($ohjelma->kayttajatunnus); ?> 
  />

  <!-- Ohjelman nimi -->
  <div>
    <label for='ohjelma-nimi'>Ohjelman nimi</label>
    <input type='text' name='nimi' 
      id='ohjelma-nimi' value='<?= $ohjelma->nimi; ?>'
    />
  </div>

  <!-- Ohjelman vaikeustaso -->
  <div>
    <label for='ohjelma-vaikeustasoId'>Vaikeustaso</label>
    <select name='vaikeustaso' id='ohjelma-vaikeustasoId'>

      <?php foreach ($vaikeustasot as $vaikeustaso): ?>
          <option
            value=<?= $vaikeustaso->vaikeustasoId; ?> 
            <?= $vaikeustaso->vaikeustasoId == $ohjelma->vaikeustasoId ? 'selected' : '' ?>>
              <?= $vaikeustaso->nimi; ?>
          </option>  
      <?php endforeach; ?>

    </select>
  </div>

  <!-- Napit -->
  <button type='submit' class='nappi-p'>Päivitä tiedot</button>
  <a href='ohjelmani.php' class='nappi nappi-s'>Takaisin</a>
</form> <!--==== OHJELMAN TIETOJEN MUOKKAUSLOMAKE LOPPU ====-->



<!--==== UUDEN HARJOITUKSEN LISÄYSLOMAKE ====-->
<form id='harjoitus-lomake' class='valia keskita'>
  <!-- Ohjelma ID -->
  <input type='hidden' name='ohjelmaId' 
    id='harjoitus-ohjelma' value=<?= $ohjelmaID; ?>
  />

  <!-- Harjoituksen nimi -->
  <div>
    <label for='harjoitus-nimi'>Harjoituksen nimi</label>
    <input type='text' name='nimi' id='harjoitus-nimi'/>
  </div>
  <!-- Nappi -->
  <button type='submit' class='nappi-p'>Lisää harjoitus +</button>
</form> <!--==== UUDEN HARJOITUKSEN LISÄYSLOMAKE LOPPU ====-->
  

<!--==== LISTA OHJELMAN HARJOITUKSISTA ====-->
<section class='keskita'>
  <header>
    <h2 class='keskella'>Harjoitukset</h2>
  </header>

  <div id='harjoitukset' class='sailio sailio-keskita'>
    
    <?php 
      // Listataan kaikki harjoitukset ja niille kontrollit
      foreach ($harjoitukset as $harjoitus) 
      {
        HarjoitusSection($harjoitus);
      } 
    ?> 
  
  </div>
</section>

<script src='./Scripts/muokkaa_ohjelma.js'></script>
 
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
