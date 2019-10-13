<?php function VaiheTR($vaihe, $kontrollit = false) { 
  
?>

  <tr class='vaihe-tr' id='vaihe-<?= $vaihe->vaiheId; ?>'>

    <?php
      require_once(__DIR__.'/vaihe_tr_content.php');
      VaiheTRContent($vaihe, $kontrollit);
    ?>

  </tr>

<?php } ?>