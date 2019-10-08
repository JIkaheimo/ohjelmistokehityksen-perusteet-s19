<?php
  require_once(__DIR__.'/Komponentit/Header/header.php');
  Headeri('Etusivu');
  
  // Näytetään etusivulla eri näkymä vierailijoille ja kirjautuneille.
  if ($kayttaja)
  {
    require_once(__DIR__.'/Komponentit/etusivu_kirjautunut.php');
  }
  else
  {
    require_once(__DIR__.'/Komponentit/etusivu_vierailija.php');
  }
  
?>
