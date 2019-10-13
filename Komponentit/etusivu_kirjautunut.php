<?php
  /**
   * Kirjautuneen käyttäjän etusivun koontinäkymä.
   * Listaa käyttäjän omat ohjelmat ja viimeaikaiset suoritukset.
   */

  // Haetaan käyttäjän kaikki ohjelmat
  $kayttajanOhjelmat = Ohjelmat::haeKayttajan($db, $kayttaja);

  // Haetaan viimeisimmät suoritukset (=5kpl)
  $viimeisimmatSuoritukset = Suoritukset::haeKayttajanViimeisimmat($db, $kayttaja);
?>

<header>
  <h1><?= htmlspecialchars($kayttaja); ?> hallintapaneeli</h1>
</header>

<!-- OMAT OHJELMAT -->
<section id='omat-ohjelmat'>
  <header>
    <h2>Omat ohjelmat</h2>
    <a class='nappi nappi-p' href='ohjelmani.php'>Hallinnoi</a>
  </header>

  <?php if (!empty($kayttajanOhjelmat)): ?>

    <!-- Näytetään kaikki käyttäjän omat ohjelmat -->
    <ul>
      <?php foreach ($kayttajanOhjelmat as $ohjelma) { ?>
        <li><a href='ohjelma.php?id=<?=$ohjelma->ohjelmaId?>'><?=$ohjelma->nimi?></a></li>
      <?php } ?>
    </ul>

  
  <?php else: ?>

    <p>Sinulla ei ole vielä ohjelmia...</p>
  
  <?php endif; ?>

</section> <!-- END OMAT OHJELMAT -->

<!-- VIIMEAIKAISET SUORITUKSET -->
<section id='viimeaikaiset-suoritukset'>
  <header>
    <h2>Viimeaikaiset suoritukset</h2>
    <a class='nappi nappi-p' href='suoritukset.php'>Hallinnoi</a>
  </header>

  <?php if (!empty($viimeisimmatSuoritukset)): ?>

    <!-- Näytetään viimeaikaiset suoritukset (5kpl) -->
    <table>
      <thead>
        <tr>
          <th>Päivämäärä</th>
          <th>Harjoitus</th>
          <th>Ohjelma</th>
          <th>Kesto (min)</th>
        </tr>
      </thead>
      <tbody>
        <!-- Näytetään käyttäjän viimeisimmät suoritukset tr-elementteinä -->
        <?php foreach ($viimeisimmatSuoritukset as $suoritus) { ?>
          <tr class='suoritus-tr'>
            <th><?= $suoritus->suoritusPvm; ?></th>
            <td><?= htmlspecialchars($suoritus->harjoitus); ?></td>
            <td>
              <a href='ohjelma.php?id=<?= $suoritus->ohjelmaId; ?>'><?= htmlspecialchars($suoritus->ohjelma); ?></a>
            </td>
            <td><?= $suoritus->kesto ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  
  <?php else: ?>

      <!-- Informatiivinen teksti etei käyttäjällä ole vielä suorituksia -->
      <p>Sinulla ei ole vielä suorituksia...</p>
    
  <?php endif; ?> 

</section> <!-- END VIIMEAIKAISET SUORITUKSET -->

<?php 
  require_once(__DIR__.'/footer.php');
  Footer();
?>
