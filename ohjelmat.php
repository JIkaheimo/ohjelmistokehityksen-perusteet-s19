<?php

  require_once(__DIR__.'/Komponentit/Header/header.php');
  require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_section.php');

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  Headeri('Ohjelmat');

  $suosituimmat = Ohjelmat::hae($db);

  $uusimmat = $suosituimmat
?>


<header>
  <h1>Ohjelmat</h1>
  <a class='nappi nappi-p' href='ohjelmani.php'>Omat ohjelmani</a>
  <a class='nappi nappi-p' href='lisaykset.php'>Lisäykset</a>
</header>

<section id='suosituimmat'>
  <header>
    <h2>Suosituimmat</h2>
  </header>
  <div class='sailio'>
    <?php 
      foreach ($suosituimmat as $ohjelma) 
      { 
        OhjelmaSection($ohjelma);
      } 
    ?>
  </div>
</section>

<section id='uudet'>
  
  <header>
    <h2>Uudet</h2>
  </header>

  <div class='sailio'>
    <?php 
      foreach ($uusimmat as $ohjelma) 
      { 
        OhjelmaSection($ohjelma);
      } 
    ?>
  </div>
</section>

<section id='kaikki-ohjelmat'>
  
  <header>
    <h2 class='keskita'>Hae ohjelmia</h2>
  </header>
  
  <!-- TODO: Hae ohjelmat AJAXin avulla kun jokin kenttä muuttuu -->
  <form class='keskita'>

    <div>
      <label for='ohjelma'>Nimi</label>
      <input type='text' name='ohjelma' id='ohjelma'>
    </div>

  </form>

  <div id='kaikki-ohjelmat-container' class='sailio'>
  </div>
</section>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

