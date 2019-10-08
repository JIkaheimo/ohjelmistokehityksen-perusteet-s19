(function() {
  const $suorituslomake = document.querySelector('form#suorituslomake');
  const $kayttaja = document.querySelector('input#kayttaja');
  const $kesto = document.querySelector('input#kesto');
  const $paivays = document.querySelector('input#paivays');
  const $ohjelma = document.querySelector('select#ohjelma');
  const $harjoitus = document.querySelector('select#harjoitus');

  $suorituslomake.addEventListener('submit', lisaaSuoritus);
  $ohjelma.addEventListener('change', paivitaHarjoitukset);

  function lisaaSuoritus(event) {
    event.preventDefault();

    const kayttajatunnus = $kayttaja.value;
    const kesto = $kesto.value;
    const paivays = $paivays.value;
    const harjoitus = $harjoitus.value;

    const body = {
      kayttajatunnus: kayttajatunnus,
      kesto: kesto,
      paivays: paivays,
      harjoitusId: harjoitus
    };

    request('./Api/suoritukset.php').post(
      body,
      function naytaOnnistuminen(res) {
        sessionStorage.setItem('viesti', res.viesti);
        window.location.href = 'suoritukset.php';
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }

  function paivitaHarjoitukset(event) {
    const ohjelmaId = event.target.value;

    request('./Api/harjoitukset.php').get(
      'ohjelma=' + ohjelmaId,
      function onSuccess(res) {
        const harjoitukset = res.harjoitukset;
        while ($harjoitus.firstChild) {
          $harjoitus.removeChild($harjoitus.firstChild);
        }

        harjoitukset.forEach(lisaaHarjoitusNode);
      },
      function onFail(res) {}
    );
  }

  function lisaaHarjoitusNode(harjoitus) {
    const $harjoitusOption = document.createElement('option');
    $harjoitusOption.value = harjoitus.harjoitusId;
    $harjoitusOption.textContent = harjoitus.nimi;
    $harjoitus.appendChild($harjoitusOption);
  }
})();
