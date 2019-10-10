<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }

  $harjoitusId = $_GET['id'];

  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

  Headeri('Muokkaa harjoitusta');

  $harjoitus = Harjoitukset::hae($db, $harjoitusId);
?>

<header>
  <h1 class='keskella'>Muokkaa harjoitusta</h1>
</header>

<!-- ITSE OHJELMAN TIETOJEN MUOKKAUSLOMAKE -->
<form id='harjoituslomake' class='keskita'>
  <input type='hidden' name='id' 
    id='harjoitus-id' value=<?= $harjoitus->harjoitusId; ?>
  />

  <div>
    <label for='harjoitus-nimi'>Harjoituksen nimi</label>
    <input type='text' name='nimi' 
      id='harjoitus-nimi' value='<?= htmlspecialchars($harjoitus->nimi); ?>'
    />
  </div>

  <button type='submit' class='nappi-p'>Päivitä tiedot</button>
  <a href='muokkaa_ohjelma.php?id=<?= $harjoitus->ohjelmaId ?>' class='nappi nappi-s'>Takaisin</a>
</form>


<section>
  <header>
    <h2 class="keskita">Vaiheet</h2>
  </header>

  <!-- VAIHEIDEN LISÄYSLOMAKE -->

  <form id='vaihelomake' class='keskita'>
    <input type='hidden' id="vaihe-harjoitus" value=<?= $harjoitus->harjoitusId ?> name='harjoitusId'>
    <div>
      <label for='vaihe-nimi'>Vaiheen nimi</label>
      <input type='text' name='nimi' id='vaihe-nimi'>
    </div>
    <button type='submit' class='nappi-p'>Lisää vaihe +</button>
  </form>
  <div id='vaiheet' class='sailio sailio-keskita'>
    <table>   
    <thead>
      <tr>
        <th>Vaihe</th>
        <th>Kuvaus</th>
        <th>Ohjelinkki</th>
        <th></th>
      </tr>
    </thead>
      <tbody>
        <?php 
          foreach ($harjoitus->vaiheet as $vaihe)
          {
            VaiheTR($vaihe, true);
          }
        ?>
      </tbody>
    </table>
  </div>
</section>

<script src='./Scripts/muokkaa_harjoitus.js'></script>
 
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
