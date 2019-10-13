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
        ilmoitus.naytaOnnistunut('Käyttäjää seurattiin onnistuneesti!')
        muokkaaLomake($seurauslomake, true);
      },
      function (res) {
        ilmoitus.naytaVirhe('Käyttäjää ei pystytty seuraamaan')
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  } // LISAA_SEURAUS_END

  function poistaSeuraus(event) {
    event.preventDefault();

    request('./Api/seuraukset.php').delete(
      lomaketiedot(),
      function (res) {
        ilmoitus.naytaOnnistunut('Käyttäjän seuraus poistettiin onnistuneesti!')
        muokkaaLomake($seurauslomake);
      },
      function (res) {
        ilmoitus.naytaVirhe('Seurausta ei pystytty poistamaan...');
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

  function muokkaaLomake($lomake, poistava) {
    poistava = poistava === undefined ? true : poistava;

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

