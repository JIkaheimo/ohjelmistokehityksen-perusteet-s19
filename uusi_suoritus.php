<?php 
  require_once(__DIR__.'/Komponentit/Header/header_kirjautunut.php'); 
  HeaderKirjautunut('Uusi suoritus');
?>

<header>
  <h1 class="keskella">Lisää suoritus</h1>
</header>

<?php
  require_once(__DIR__.'/Komponentit/Suoritukset/suoritus_form.php');
  SuoritusForm('./Api/uusi_suoritus.php');
?>

<?php 
  require_once(__DIR__.'/Komponentit/footer.php');
  Footer();
?>