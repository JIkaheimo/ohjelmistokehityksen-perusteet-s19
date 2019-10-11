(function () {
  // DOM-ELEMENTIT ====================================================
  const $harjoituslomake = document.querySelector('form#harjoituslomake');
  const $harjoitusId = document.querySelector('input#harjoitus-id');
  const $harjoitusNimi = document.querySelector('input#harjoitus-nimi');

  const $vaihelomake = document.querySelector('form#vaihelomake');
  const $vaiheHarjoitus = document.querySelector('input#vaihe-harjoitus');
  const $vaiheNimi = document.querySelector('input#vaihe-nimi');

  $harjoituslomake.addEventListener('submit', paivitaHarjoitus);
  $vaihelomake.addEventListener('submit', uusiVaihe);

  // Lisätään poistonappeihin poisto-funktionaalisuus.
  const $poistolomakkeet = document.querySelectorAll(
    'form.poistolomake'
  );

  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

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
  }


  function uusiVaihe(event) {
    event.preventDefault();

    const body = {
      harjoitusId: $vaiheHarjoitus.value,
      nimi: $vaiheNimi.value
    };

    request('./Api/vaiheet.php').post(
      body,
      function (res) {
        console.log(res);
      },
      function (res) {
        console.error(res);
      }
    );
  }


  // VAIHEIDEN POISTO ===========================================================

  function lisaaPoistaja($lomake) {
    $lomake.addEventListener('submit', poistaVaihe($lomake.dataset.id));
  }

  function poistaVaihe(id) {
    /**
     * poistaHarjoitus - Palauttaa 'räätälöidyn' funktion tietyn harjoituksen poistamiseksi.
     */
    return function (event) {
      // Estetään lomakkeen submitointi.
      event.preventDefault();
      const body = {
        id: id
      };

      // Lähetetään DELETE-pyyntö Apille harjoituksen poistamiseksi.
      request('./Api/vaiheet.php').delete(
        body,
        function poistaSivulta(res) {
          ilmoitus.naytaOnnistunut('Vaihe poistettiin onnistuneesti.');

        },
        function naytaVirhe(res) {
          ilmoitus.naytaVirhe(res.viesti);
        }
      );
    };
  } // END
})();
