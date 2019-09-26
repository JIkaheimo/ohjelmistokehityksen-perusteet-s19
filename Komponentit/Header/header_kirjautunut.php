<?php 
  function HeaderKirjautunut($otsikko) { 
    require_once(__DIR__.'/header.php');
    Header_($otsikko);
?>

<header class="flex">
  <nav class="kapea">
    <a href="index_kirjautunut.php">REENIKIRJA</a>
    <ul>
      <li><a class=<?=($otsikko == 'Ohjelmat') ? 'valittu' : 'ei-valittu'?> href="ohjelmat.php">Ohjelmat</a></li>
      <li><a class=<?=($otsikko == 'Suoritukset') ? 'valittu' : 'ei-valittu'?> href="suoritukset.php">Suoritukset</a></li>
      <li><a class=<?=($otsikko == 'Käyttäjät') ? 'valittu' : 'ei-valittu'?> href="kayttajat.php">Käyttäjät</a></li>
      <li class="oikealle"><a class=<?=($otsikko == 'Oma profiili') ? 'valittu' : 'ei-valittu'?> href="profiili.php">Profiili</a></li>
      <li><a href="./Api/uloskirjaudu.php">Kirjaudu ulos</a></li>
    </ul>
  </nav>
</header>

<main class="kapea">

<?php } ?>