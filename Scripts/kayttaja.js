const alustaSeurauslomake = (function() {
  // DOM-ELEMENTIT =================================================
  const $seurauslomake = document.querySelector('form#seurauslomake');
  const $seuraaja = document.querySelector('input#seuraaja');
  const $seurattava = document.querySelector('input#seurattava');
  const $lomakenappi = document.querySelector('button#laheta');

  // LISTENERIT ======================================================
  return function alustaLomake(onkoSeurattu) {
    if (onkoSeurattu) $seurauslomake.addEventListener('submit', poistaSeuraus);
    else $seurauslomake.addEventListener('submit', lisaaSeuraus);
  };

  // CALLBACKIT =====================================================
  function lisaaSeuraus(event) {
    event.preventDefault();

    request('./Api/seuraukset.php').post(
      lomaketiedot(),
      function (res) {
        console.log(res);
      },
      function(res)
      {
        console.error(res);
      }
    )
  }

  function poistaSeuraus(event) {
    event.preventDefault();

    request('./Api/seuraukset.php').delete(
      lomaketiedot(),
      function (res) {
        console.log(res);
      },
      function (res) {
        console.error(res);
      }
    )
  }

  // HELPPERIT =======================================================
  function lomaketiedot() {
    return {
      seuraaja: $seuraaja.value,
      seurattava: $seurattava.value
    }
    
    function muokkaaLomake($lomake, poistava = false) {
      if (poistava) {
        $lomake.removeEventListener('submit', lisaaSeuraus);
        $lomake.addEventListener('submit', poistaSeuraus);
        $lomakenappi.textContent = 'Poista lisäys';
      } else {
        $lomake.removeEventListener('submit', poistaSeuraus);
        $lomake.addEventListener('submit', lisaaSeuraus);
        $lomakenappi.textContent = 'Lisää +';
      }
    }

})();

