<?php 

// Varmistetaan että kayttaja-polulle on annettu id (käyttäjätunnus))
if (!isset($_GET['id'])) {
  header('Location: 404.php');
}

$kayttajatunnus = $_GET['id'];

require_once(__DIR__.'/Komponentit/Header/header.php'); 

// Varmistetaan että käyttäjä on kirjautunut
if ($kayttaja == null)
{
  header('Location: 401.php');
}

require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_section.php');

Headeri($kayttajatunnus);

// Haetaan kyseisen käyttäjän tiedot
$kayttajatiedot = Kayttajat::kayttaja($db, $kayttajatunnus);
$ohjelmat = Ohjelmat::haeKayttajan($db, $kayttajatunnus);
$onkoSeurattu = Kayttajat::onkoSeurattu($db, $kayttaja, $kayttajatunnus);

?>


<header>
  <h1><?=$kayttajatiedot->kayttajatunnus?></h1>
  
  <form id='seurauslomake'>
    <input type='hidden' name='seuraaja' id='seuraaja' value=<?= $kayttaja; ?> />
    <input type='hidden' name='seurattava' id='seurattava' value=<?= $kayttajatunnus; ?> />
    <button type='submit' id='laheta' class='nappi-p'><?= $onkoSeurattu ? 'Poista seuraus' : 'Seuraa +'; ?></button>
  </form>

</header>

<div class='sailio'>
<img class='img valia kayttaja-kuva' src=<?= './Assets/Kayttajat/' . $kayttajatiedot->kuva; ?> alt=<?= $kayttajatunnus; ?>>

<section>
  <header>
    <h2>Kuvaus</h2>
  </header>
  <p><?=$kayttajatiedot->kuvaus ?: 'Tämä käyttäjä ei ole vielä kirjoittanut kuvausta...'?></p>
</section>
</div>


<section>
  <header>
    <h2>Käyttäjän ohjelmat</h2>
  </header>

  <!-- Näytetään kaikki käyttäjän ohjelmat (jos niitä on) -->
  <?php if ($ohjelmat): ?>

    <div class='sailio'>
      <?php 
        foreach ($ohjelmat as $ohjelma) 
        { 
          OhjelmaSection($ohjelma);
        } 
      ?>
    </div>
  
  <?php else: ?>

    <p>Tällä käyttäjällä ei ole ohjelmia.</p>
  
  <?php endif; ?>
</section>

<script src='./Scripts/kayttaja.js'></script>
<script>alustaSeurauslomake(<?= $onkoSeurattu ?>);</script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
