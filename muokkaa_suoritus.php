<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Suoritus 21.09.2019');
?>

<header>
  <h1 class="keskella">Muokkaa suoritusta</h1>
</header>

<?php
  require_once(__DIR__.'/Komponentit/Suoritukset/suoritus_form.php');
  SuoritusForm('./Api/muokkaa_suoritus.php');
?>

    
<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>