const alustaSeurauslomake = (function () {
  // DOM-ELEMENTIT =================================================
  const $seurauslomake = document.querySelector('form#seurauslomake');
  const $seuraaja = document.querySelector('input#seuraaja');
  const $seurattava = document.querySelector('input#seurattava');
  const $lomakenappi = document.querySelector('button#laheta');
  const $lomakenappiTeksti = document.querySelector('button#laheta > i');

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
        muokkaaLomake($seurauslomake, true);
      },
      function (res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  }

  function poistaSeuraus(event) {
    event.preventDefault();

    request('./Api/seuraukset.php').delete(
      lomaketiedot(),
      function (res) {
        muokkaaLomake($seurauslomake);
      },
      function (res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  }

  // HELPPERIT =======================================================
  function lomaketiedot() {
    return {
      seuraaja: $seuraaja.value,
      seurattava: $seurattava.value
    }
  }

  function muokkaaLomake($lomake, poistava = false) {
    if (poistava) {
      $lomake.removeEventListener('submit', lisaaSeuraus);
      $lomake.addEventListener('submit', poistaSeuraus);
      $lomakenappiTeksti.textContent = 'remove';
      $lomakenappi.textContent = 'Poista seuraus';
    } else {
      $lomake.removeEventListener('submit', poistaSeuraus);
      $lomake.addEventListener('submit', lisaaSeuraus);
      $lomakenappi.textContent = 'Seuraa';
      $lomakenappiTeksti.textContent = 'add';
    }
    $lomakenappi.classList.toggle('nappi-d');
    $lomakenappi.appendChild($lomakenappiTeksti);
  }

})();

