<?php 

require_once(__DIR__.'/Komponentit/Kayttajat/kayttaja_section.php');
require_once(__DIR__.'/Komponentit/Header/header.php'); 

if ($kayttaja == null)
{
  header('Location: 401.php');
}

Headeri('Käyttäjät');

$kayttajat = array_filter(Kayttajat::hae($db));

// Nämä voisi periaatteessa hakea myös usortin avulla.
$suosituimmat = Kayttajat::suosituimmat($db);
$seuratut = Kayttajat::seuratut($db, $kayttaja);

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
      foreach ($suosituimmat as $kayttaja) 
      { 
        KayttajaSection($kayttaja);
      } 
    ?>
  </div>
</section>

<?php if (!empty($seuratut)): ?>
  <section>
    <!-- SEURATUT KÄYTTÄJÄT KAIKKI -->
    <header>
      <h2>Seuratut</h2>
    </header>

    
    <div id='seuratut' class='sailio'>
      <?php 
        foreach ($seuratut as $kayttaja) 
        { 
          KayttajaSection($kayttaja);
        } 
      ?>
    </div>
  </section>
<?php endif;?>

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
    <?php 
      foreach ($kayttajat as $kayttaja) 
      { 
        KayttajaSection($kayttaja);
      } 
    ?>  
  </div>
</section>

<script src='./Scripts/kayttajat.js'></script>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>
