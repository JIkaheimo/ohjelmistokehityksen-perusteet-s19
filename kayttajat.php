<?php 

require_once(__DIR__.'/Komponentit/Kayttajat/kayttaja_section.php');
require_once(__DIR__.'/Komponentit/Header/header.php'); 

if ($kayttaja == null)
{
  header('Location: 401.php');
}

Headeri('Käyttäjät');

// TODO: Hae kaikistä käyttäjistä suosituimmat ja seuratut.
$kayttajat = Kayttajat::hae($db);
$kayttajat = array_slice($kayttajat, 0, 4);

?>

<header>
  <h1>Käyttäjät</h1>
</header>

<section>
  <!-- SUOSITUIMMAT KÄYTTÄJÄT 4KPL (ENITEN SEURAAJIA) -->
  <header>
    <h2>Suosituimmat</h2>
  </header>
  <div id='suosituimmat' class='sailio'> 
    <?php 
      foreach ($kayttajat as $kayttaja) 
      { 
        KayttajaSection($kayttaja);
      } 
    ?>
  </div>
</section>

<section>
  <!-- SEURATUT KÄYTTÄJÄT KAIKKI -->
  <header>
    <h2>Seuratut</h2>
  </header>
  <div id='seuratut' class='sailio'>
    <?php 
      foreach ($kayttajat as $kayttaja) 
      { 
        KayttajaSection($kayttaja);
      } 
    ?>
  </div>
</section>

<section id='kaikki-kayttajat'>
  <!-- LISTA KAIKISTA KÄYTTÄJISTÄ (HAE SKROLLATESSA LISÄÄ) -->
  <header>
    <h2 class='keskella'>Hae käyttäjiä</h2>
  </header>

  <form id='kayttaja-lomake' class='keskita' action='#'>
    <div>
      <label for='kayttaja'>Nimi</label>
      <input type='text' name='nimi' id='kayttaja-nimi'>
    </div>

  </form>

  <div id='kaikki-kayttajat-container' class='sailio valia'>
  </div>
</section>

<script src='./Scripts/kayttajat.js'></script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
