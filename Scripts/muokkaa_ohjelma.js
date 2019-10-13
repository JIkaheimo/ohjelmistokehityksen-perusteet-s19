/**
 * muokkaa_ohjelma.js (muokkaa_ohjelma.php)
 */

(function () {
  // DOM-ELEMENTIT ============================================================

  // Ohjelman tietojen muokkaus
  const $ohjelmalomake = document.querySelector('form#ohjelmalomake');
  const $ohjelmaKayttaja = document.querySelector('input#ohjelma-kayttaja');
  const $ohjelmaId = document.querySelector('input#ohjelma-id');
  const $ohjelmaNimi = document.querySelector('input#ohjelma-nimi');
  const $ohjelmaVaikeustasoId = document.querySelector(
    'select#ohjelma-vaikeustasoId'
  );

  // Harjoituksen lisäys
  const $harjoituslomake = document.querySelector('form#harjoituslomake');
  const $harjoitusOhjelma = document.querySelector('input#harjoitus-ohjelma');
  const $harjoitusNimi = document.querySelector('input#harjoitus-nimi');

  // Harjoitukset
  const $harjoitukset = document.querySelector('tbody#harjoitukset-body');

  // Harjoitusten poistaminen
  const $poistolomakkeet = document.querySelectorAll(
    'form.poista-harjoitus-lomake'
  );

  $ohjelmalomake.addEventListener('submit', paivitaOhjelma);
  $harjoituslomake.addEventListener('submit', lisaaHarjoitus);

  // Lisätään listenerit harjoitusten poistamiseksi.
  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

  // MUOKKAA_OHJELMA ===============================================================
  function paivitaOhjelma(event) {
    /**
     * muokkaaOhjelma - Huolehtii muokatun ohjelman tietojen lähetyksestä APIin,
     * sekä tulostaa pyynnön onnistumisen/epäonnistumisen.
     */

    // Estetään lomakkeen submitointi.
    event.preventDefault();

    // Tarkistetaan että ohjelmalla on sopiva nimi.
    const nimi = $ohjelmaNimi.value;
    if (nimi.length < 10) {
      ilmoitus.naytaVirhe('Ohjelman nimessä tulee olla vähintään 10 merkkiä.');
      ilmoitus.naytaLomakevirhe($ohjelmaNimi);
      return;
    }

    if (!nimi.onkoSallitutMerkit()) {
      ilmoitus.naytaVirhe('Ohjelman nimi sisältää ei sallittuja merkkejä.');
      ilmoitus.naytaLomakevirhe($ohjelmaNimi);
      return;
    }

    // Haetaan ja muodostetaan tarvittava pyynnön runko ohjelman muokkaamiseksi.
    const body = {
      id: $ohjelmaId.value,
      kayttajatunnus: $ohjelmaKayttaja.value,
      nimi: $ohjelmaNimi.value,
      vaikeustasoId:
        $ohjelmaVaikeustasoId.options[$ohjelmaVaikeustasoId.selectedIndex].value
    };

    // Lähetetään PUT-pyyntö Apille, joka suorittaa ohjelman päivittämisen.
    request('./Api/ohjelmat.php').put(
      body,
      function naytaOnnistunut(res) {
        ilmoitus.naytaOnnistunut('Ohjelma päivitettiin onnistuneesti!');
      },
      function naytaVirhel(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  } // MUOKKAA_OHJELMA_END


  // LISAA_HARJOITUS ===========================================================
  function lisaaHarjoitus(event) {
    /**
     * lisaaHarjoitus - Huolehtii harjoituksen lisäämisestä tietokantaan Apin kautta.
     */

    // Estetään lomakkeen submitointi.
    event.preventDefault();

    // Haetaan ja muodostetaan tarvittava pyynnön runko harjoituksen lisäämiseksi.
    const body = {
      ohjelmaId: $harjoitusOhjelma.value,
      nimi: $harjoitusNimi.value
    };

    // Lähetetään POST-pyyntö Apille harjoituksen lisäämiseksi.
    request('./Api/harjoitukset.php').post(
      body,
      haeHarjoituskomponentti,
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  } // LISAA_HARJOITUS_END


  // HAE_HARJOITUSKOMPONENTTI ======================================================
  function haeHarjoituskomponentti(harjoitus) {

    ilmoitus.naytaOnnistunut('Harjoituksen lisääminen onnistui!');

    // Generoidaan harjoituksen tr-komponentti serverillä.
    request('./Api/harjoitukset.php').get(
      'tr=true&id=' + harjoitus.harjoitusId,
      function lisaaHarjoituskomponentti($harjoitusTd) {
        const $harjoitusTr = document.createElement('tr');
        $harjoitusTr.id = 'harjoitus-' + harjoitus.harjoitusId;
        $harjoitusTr.classList.add('harjoitus-tr');
        $harjoitusTr.innerHTML = $harjoitusTd;

        $harjoitukset.appendChild($harjoitusTr);

        const $poistolomake = document.querySelector('form#poista-harjoitus-' + harjoitus.harjoitusId);
        lisaaPoistaja($poistolomake);
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    )
  } // HAE_HARJOITUSKOMPONENTTI_END


  // HARJOITUSTEN POISTO ===========================================================

  function lisaaPoistaja($lomake) {
    $lomake.addEventListener('submit', poistaHarjoitus($lomake.dataset.id));
  }

  function poistaHarjoitus(id) {
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
      request('./Api/harjoitukset.php').delete(
        body,
        function poistaSivulta(res) {
          ilmoitus.naytaOnnistunut('Harjoitus poistettiin onnistuneesti.');
          const $harjoitus = document.querySelector('#harjoitus-' + id);
          $harjoitus.parentNode.removeChild($harjoitus);
        },
        function naytaVirhe(res) {
          ilmoitus.naytaVirhe(res.viesti);
        }
      );
    };
  } // END
})();
