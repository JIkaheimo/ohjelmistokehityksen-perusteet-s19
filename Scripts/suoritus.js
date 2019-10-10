const asetaPyynto = (function () {
  let pyyntotyyppi = 'post';
  const $suorituslomake = document.querySelector('form#suorituslomake');
  const $suoritus = document.querySelector('input#suoritus');
  const $kayttaja = document.querySelector('input#kayttaja');
  const $kesto = document.querySelector('input#kesto');
  const $paivays = document.querySelector('input#paivays');
  const $ohjelma = document.querySelector('select#ohjelma');
  const $harjoitus = document.querySelector('select#harjoitus');

  $suorituslomake.addEventListener('submit', lisaaSuoritus);
  $ohjelma.addEventListener('change', paivitaHarjoitukset);

  return function (tyyppi) {
    pyyntotyyppi = tyyppi;
  };

  function lisaaSuoritus(event) {
    event.preventDefault();

    const kayttajatunnus = $kayttaja.value;
    const kesto = $kesto.value;
    const paivays = $paivays.value;
    const harjoitus = $harjoitus.value;
    const suoritus = $suoritus ? $suoritus.value : null;

    const body = {
      id: suoritus,
      kayttajatunnus: kayttajatunnus,
      kesto: kesto,
      paivays: paivays,
      harjoitusId: harjoitus
    };

    request('./Api/suoritukset.php')[pyyntotyyppi](
      body,
      function naytaOnnistuminen(res) {
        if (pyyntotyyppi == 'post') {
          sessionStorage.setItem('viesti', 'Uusi suoritus lisättiin onnistuneesti!');
          window.location.href = 'suoritukset.php';
        } else {
          ilmoitus.naytaOnnistunut('Suoritus päivitettiin onnistuneesti!');
        }
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
        while ($harjoitus.firstChild) {
          $harjoitus.removeChild($harjoitus.firstChild);
        }
        const harjoitukset = res.harjoitukset;
        harjoitukset.forEach(lisaaHarjoitusNode);
      },
      function onFail(res) {
        while ($harjoitus.firstChild) {
          $harjoitus.removeChild($harjoitus.firstChild);
        }
      }
    );
  }

  function lisaaHarjoitusNode(harjoitus) {
    const $harjoitusOption = document.createElement('option');
    $harjoitusOption.value = harjoitus.harjoitusId;
    $harjoitusOption.textContent = harjoitus.nimi;
    $harjoitus.appendChild($harjoitusOption);
  }
})();
