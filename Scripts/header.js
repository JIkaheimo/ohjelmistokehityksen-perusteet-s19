/**
 * Tämä koodi hoitaa sivuston erilaiset ilmoitukset.
 */

const ilmoitus = (function() {
  const $ilmoittaja = document.querySelector('#ilmoittaja');

  // Jos sessioon on viesti tallennettun sivun ladatessa, näytetään se käyttäjälle.
  const viesti = sessionStorage.getItem('viesti');
  if (viesti) {
    sessionStorage.removeItem('viesti');
    naytaTyyli($ilmoittaja, 'onnistunut')(viesti);
  }

  return {
    naytaOnnistunut: naytaTyyli($ilmoittaja, 'onnistunut'),
    naytaVirhe: naytaTyyli($ilmoittaja, 'virhe'),
    naytaLomakevirhe: naytaLomakevirhe
  };

  function naytaTyyli($elementti, tyyli) {
    return function(teksti) {
      $elementti.textContent = teksti;
      $elementti.classList.add(tyyli);

      setTimeout(function piilotaIlmoittaja() {
        $elementti.classList.remove(tyyli);
      }, 3000);
    };
  }

  function naytaLomakevirhe($lomakekentta) {
    $lomakekentta.classList.add('virhe');

    setTimeout(function piilotaVirhe() {
      $lomakekentta.classList.remove('virhe');
    }, 3000);
  }
})();
