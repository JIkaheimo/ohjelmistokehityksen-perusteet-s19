const alustaLomake = (function () {
  // DOM-ELEMENTIT =================================================
  const $lisayslomake = document.querySelector('form#lisayslomake');
  const $kayttajatunnus = document.querySelector('input#kayttaja');
  const $ohjelma = document.querySelector('input#ohjelma');
  const $lomakenappi = document.querySelector('button#laheta');
  const $lomakenappiTeksti = document.querySelector('button#laheta > i');

  // LISTENERIT =====================================================
  return function alustaLomake(onkoLisatty) {
    if (onkoLisatty) $lisayslomake.addEventListener('submit', poistaLisays);
    else $lisayslomake.addEventListener('submit', lisaaLisays);
  };

  // CALLBACKIT =====================================================
  function lisaaLisays(event) {
    event.preventDefault();

    request('./Api/lisaykset.php').post(
      lomaketiedot(),
      function (res) {
        muokkaaLomake($lisayslomake, true);
        ilmoitus.naytaOnnistunut('Ohjelma lisättiin onnistuneesti!');
      },
      function (res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }

  function poistaLisays(event) {
    event.preventDefault();

    request('./Api/lisaykset.php').delete(
      lomaketiedot(),
      function (res) {
        muokkaaLomake($lisayslomake);
        ilmoitus.naytaOnnistunut('Lisäys poistettiin onnistuneesti!');
      },
      function (res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }

  // HELPPERIT ======================================================
  function lomaketiedot() {
    return {
      kayttajatunnus: $kayttajatunnus.value,
      ohjelmaId: $ohjelma.value
    };
  }

  function muokkaaLomake($lomake, poistava) {

    poistava = poistava === undefined ? false : poistava;

    if (poistava) {
      $lomake.removeEventListener('submit', lisaaLisays);
      $lomake.addEventListener('submit', poistaLisays);
      $lomakenappi.textContent = 'Poista lisäys';
      $lomakenappiTeksti.textContent = 'remove';
    } else {
      $lomake.removeEventListener('submit', poistaLisays);
      $lomake.addEventListener('submit', lisaaLisays);
      $lomakenappi.textContent = 'Lisää';
      $lomakenappiTeksti.textContent = 'add';
    }
    $lomakenappi.classList.toggle('nappi-d');
    $lomakenappi.appendChild($lomakenappiTeksti);
  }
})();
