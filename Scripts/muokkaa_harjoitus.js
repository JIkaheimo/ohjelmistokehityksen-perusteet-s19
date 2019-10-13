(function () {
  // DOM-ELEMENTIT ====================================================
  const $harjoituslomake = document.querySelector('form#harjoituslomake');
  const $harjoitusId = document.querySelector('input#harjoitus-id');
  const $harjoitusNimi = document.querySelector('input#harjoitus-nimi');

  const $vaihelomake = document.querySelector('form#vaihelomake');
  const $vaiheHarjoitus = document.querySelector('input#vaihe-harjoitus');
  const $vaiheNimi = document.querySelector('input#vaihe-nimi');

  // Harjoitukset
  const $vaiheet = document.querySelector('tbody#vaiheet-body');

  $harjoituslomake.addEventListener('submit', paivitaHarjoitus);
  $vaihelomake.addEventListener('submit', lisaaVaihe);

  // Lisätään poistonappeihin poisto-funktionaalisuus.
  const $poistolomakkeet = document.querySelectorAll(
    'form.poistolomake'
  );

  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

  // PAIVITA_HARJOITUS ====================================================
  function paivitaHarjoitus(event) {
    event.preventDefault();

    const body = {
      harjoitusId: $harjoitusId.value,
      nimi: $harjoitusNimi.value
    }

    request('./Api/harjoitukset.php').put(
      body,
      function naytaOnnistunut(res) {
        ilmoitus.naytaOnnistunut('Harjoitus päivitettiin onnistuneesti.');
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  } // PAIVITA_HARJOITUS_END


  // LISAA_VAIHE ============================================================
  function lisaaVaihe(event) {
    /**
     * lisaaHarjoitus - Huolehtii vaiheen lisäämisestä tietokantaan Apin kautta.
     */

    // Estetään lomakkeen submitointi.
    event.preventDefault();

    // Haetaan ja muodostetaan tarvittava pyynnön runko vaiheen lisäämiseksi.
    const body = {
      harjoitusId: $vaiheHarjoitus.value,
      nimi: $vaiheNimi.value
    };

    // Lähetetään POST-pyyntö Apille vaiheen lisäämiseksi.
    request('./Api/vaiheet.php').post(
      body,
      haeVaihekomponentti,
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );

  } // LISAA_VAIHE_END


  // HAE_HARJOITUSKOMPONENTTI ======================================================
  function haeVaihekomponentti(vaihe) {

    ilmoitus.naytaOnnistunut('Vaiheen lisääminen onnistui!');

    // Generoidaan harjoituksen tr-komponentti serverillä.
    request('./Api/vaiheet.php').get(
      'tr=true&id=' + vaihe.vaiheId,
      function lisaaVaihekomponentti($vaiheTd) {
        const $vaiheTr = document.createElement('tr');
        $vaiheTr.id = 'vaihe-' + vaihe.vaiheId;
        $vaiheTr.classList.add('vaihe-tr');
        $vaiheTr.innerHTML = $vaiheTd;

        $vaiheet.appendChild($vaiheTr);

        const $poistolomake = document.querySelector('form#poista-vaihe-' + vaihe.vaiheId);
        lisaaPoistaja($poistolomake);
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  } // HAE_HARJOITUSKOMPONENTTI_END


  // LISAA_POISTAJA ============================================================
  function lisaaPoistaja($lomake) {
    $lomake.addEventListener('submit', poistaVaihe($lomake.dataset.id));
  } // LISAA_POITAJA_END


  // POISTA_VAIHE ================================================================
  function poistaVaihe(id) {
    /**
     * poistaVaihe - Palauttaa 'räätälöidyn' funktion tietyn vaiheen poistamiseksi.
     */

    return function (event) {
      // Estetään lomakkeen submitointi.
      event.preventDefault();
      const body = {
        id: id
      };

      // Lähetetään DELETE-pyyntö Apille vaiheen poistamiseksi.
      request('./Api/vaiheet.php').delete(
        body,
        function poistaSivulta(res) {
          ilmoitus.naytaOnnistunut('Vaihe poistettiin onnistuneesti.');
          const $vaihe = document.querySelector('tr#vaihe-' + id);
          $vaiheet.removeChild($vaihe);
        },
        function naytaVirhe(res) {
          ilmoitus.naytaVirhe(res.viesti);
        }
      );
    };
  } // POISTA_VAIHE_END
})();
