<?php function HarjoitusTR($harjoitus, $kontrollit = true) { ?>

  <tr id='harjoitus-<?= $harjoitus->harjoitusId; ?>' class='harjoitus-tr'>
    <?php
      require_once(__DIR__.'/harjoitus_tr_content.php');
      HarjoitusTRContent($harjoitus, $kontrollit);
    ?>
  </tr>


<?php } ?>
