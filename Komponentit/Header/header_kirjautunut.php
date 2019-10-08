<?php function HeaderKirjautunut($otsikko) { ?>

<header class='flex'>
  <nav class='kapea'>
    <a href='index.php'>REENIKIRJA</a>
    <ul>
      <li><a class=<?=($otsikko == 'Ohjelmat') ? 'valittu' : 'ei-valittu'?> href='ohjelmat.php'>Ohjelmat</a></li>
      <li><a class=<?=($otsikko == 'Suoritukset') ? 'valittu' : 'ei-valittu'?> href='suoritukset.php'>Suoritukset</a></li>
      <li><a class=<?=($otsikko == 'Käyttäjät') ? 'valittu' : 'ei-valittu'?> href='kayttajat.php'>Käyttäjät</a></li>
      <li><a class=<?=($otsikko == 'Oma profiili') ? 'valittu' : 'ei-valittu'?> href='profiili.php'>Profiili</a></li>
      <form id='uloskirjautumislomake' class='oikealle'>
        <button class='nappi-s' type='submit'>Kirjaudu ulos</button>
      </form>
    </ul>
  </nav>
</header>

<main class='kapea'>

<script src='./Scripts/header_kirjautunut.js'></script>

<?php } ?>