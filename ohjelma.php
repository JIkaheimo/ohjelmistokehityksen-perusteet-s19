<?php 
  if (!isset($_GET['id'])) {
    http_response_code(404);
    header('Location: 404.php');
    exit;
  }

  $ohjelmaId = (int) $_GET['id'];

  require_once(__DIR__.'/Komponentit/Header/header.php'); 

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  require_once(__DIR__.'/Komponentit/Vaiheet/vaihe_tr.php');

  $ohjelma = Ohjelmat::hae($db, $ohjelmaId);
  Headeri($ohjelma->nimi);

  $onkoLisatty = Ohjelmat::onkoLisatty($db, $kayttaja, $ohjelma->ohjelmaId);
?>
      
<header>
  <h1><?= $ohjelma->nimi; ?></h1>

    <!-- LISÄYS/POISTOLOMAKE -->
    <form id='lisayslomake'>

      <input type='hidden' name='kayttaja' 
        id='kayttaja' value='<?= $kayttaja; ?>' 
      />
      
      <input type='hidden' name='ohjelma' 
        id='ohjelma' value=<?= $ohjelma->ohjelmaId; ?>
      />
      
      <button type='submit' name='submit' id='laheta' class='flex nappi-m <?= $onkoLisatty ? 'nappi-d' : ''; ?>'>
        <?= $onkoLisatty ? 'POISTA LISÄYS' : 'LISÄÄ' ?>
        <i class="material-icons">
          <?= $onkoLisatty ? 'remove' : 'add'; ?> 
        </i>
      </button>
    </form>

</header>

<p>Tekijä: <a href='kayttaja.php?id=<?= $ohjelma->kayttajatunnus; ?>'><?= $ohjelma->kayttajatunnus; ?></a></p>

<!-- LISTATAAN OHJELMAN HARJOITUKSET -->
<?php foreach ($ohjelma->harjoitukset as $harjoitus) : ?>
  <section>
    <header>
      <h2><?= 'Harjoitus: '.$harjoitus->nimi; ?></h2>
    </header>  

    <?php if (!empty($harjoitus->vaiheet)) : ?>

      <table>
        <thead>
          <tr>
            <th>Vaihe</th>
            <th>Kuvaus</th>
            <th>Ohjelinkki</th>
          </tr>
        </thead>
        <tbody>
          <!-- HARJOITUKSEN VAIHEET -->
          <?php 
            foreach ($harjoitus->vaiheet as $vaihe)
            {
              VaiheTR($vaihe);
            }
          ?>
        </tbody>
      </table>
    
    <?php else: ?>
    
      <p>Tämä harjoitus ei sisällä tarkempia tietoja...</p>
    
    <?php endif; ?>

  </section>

<?php endforeach; ?>

<script src='./Scripts/ohjelma.js'></script>
<script>alustaLomake(<?= $onkoLisatty; ?>);</script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>