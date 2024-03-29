<?php function VaiheTRContent($vaihe, $kontrollit = false) { 
  if ($kontrollit)
  {
    $vaihe->kuvaus = (strlen($vaihe->kuvaus) > 0) ? 'ON' : 'EI OLE';
  }    
?>

  <th>
    <?= $vaihe->nimi; ?>
  </th>
  
  <td>
    <?= $vaihe->kuvaus; ?>
  </td>
  
  <td>
    <?php if ($vaihe->ohjelinkki != null) { ?>
      <a href='<?= $vaihe->ohjelinkki; ?>'>Linkki</a>
    <?php } ?>
  </td>

  <?php if ($kontrollit) { ?>
    <td>
      <div class='sailio'>
        
        <a 
          class='nappi nappi-m' 
          href='muokkaa_vaihe.php?id=<?= $vaihe->vaiheId; ?>'
        >        
          <i class="material-icons">
            edit
          </i> 
        </a>
        
        <form 
          data-id=<?= $vaihe->vaiheId; ?> 
          class='poistolomake'
          id='poista-vaihe-<?= $vaihe->vaiheId; ?>'
        >

          <input type='hidden' name='id' 
            value=<?= $vaihe->vaiheId; ?> 
          />
        
          <button type='submit' class='nappi-d'>
            <i class="material-icons">
              delete_forever
            </i>
          </button>
        
        </form>

      </div>
    </td>
  <?php } ?>

<?php } ?>