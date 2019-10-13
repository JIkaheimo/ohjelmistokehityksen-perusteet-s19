<?php

  require_once(__DIR__.'/Komponentit/Header/header.php');
  require_once(__DIR__.'/Komponentit/Ohjelmat/ohjelma_section.php');

  if ($kayttaja == null)
  {
    header('Location: 401.php');
  }

  Headeri('Ohjelmat');

  $ohjelmat = Ohjelmat::hae($db);

  // Nämä voisi periaatteessa selvittää myös PHP:n usortilla.
  $suosituimmat = Ohjelmat::suosituimmat($db);
  $uusimmat = Ohjelmat::uusimmat($db);
?>

<header>
  <h1>Ohjelmat</h1>
  <a class='nappi nappi-p' href='ohjelmani.php'>Ohjelmani</a>
  <a class='nappi nappi-p' href='lisaykset.php'>Lisäykset</a>
</header>

<!-- SUOSITUIMMAT OHJELMAT -->
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
<!-- SUOSITUIMMAT OHJELMAT END -->


<!-- UUDET OHJELMAT -->
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
<!-- UUDET OHJELMAT END -->


<!-- KAIKKI OHJELMAT -->
<section id='kaikki-ohjelmat'>
  
  <header>
    <h2 class='keskita'>Hae ohjelmia</h2>
  </header>
  
  <form class='keskita'>

    <div>
      <label for='ohjelma'>Nimi</label>
      <input type='text' name='ohjelma' id='ohjelma'>
    </div>

  </form>

  <div id='kaikki-ohjelmat-container' class='sailio valia'>
    <?php 
      foreach ($ohjelmat as $ohjelma) 
      { 
        OhjelmaSection($ohjelma);
      } 
    ?>
  </div>
</section>
<!-- KAIKKI OHJELMAT END -->

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>

