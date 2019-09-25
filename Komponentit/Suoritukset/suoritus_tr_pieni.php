<?php function SuoritusTRPieni($paivays, $harjoitus, $ohjelma, $kesto, $id)  {

  require_once(__DIR__.'/suoritus_tr.php');
  SuoritusTR($paivays, $harjoitus, $ohjelma, $kesto, $id, false);
} ?>