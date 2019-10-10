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
      function onSuccess(res) {
        ilmoitus.naytaOnnistunut('Ohjelma päivitettiin onnistuneesti!');
      },
      function onFail(res) {
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
      function lisaaSivulle(res) {
        ilmoitus.naytaOnnistunut('Harjoituksen lisääminen onnistui!');
        lisaaHarjoitusElementti(res);
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  } // LISAA_HARJOITUS_END


  // LISAA_HARJOITUS_ELEMENTTI =====================================================
  function lisaaHarjoitusElementti(harjoitus) {
    // Tämän olisi periaatteessa voinut hakea serveriltä siistimmässä muodossa.

    const $harjoitusTr = document.createElement('tr');
    $harjoitusTr.id = 'harjoitus-' + harjoitus.harjoitusId;
    $harjoitusTr.classList.add('harjoitus-tr');

    const $nimiTd = document.createElement('td');
    $nimiTd.textContent = harjoitus.nimi;

    const $kontrollitTd = document.createElement('td');

    const $kontrollitDiv = document.createElement('div');
    $kontrollitDiv.classList.add('sailio', 'flex-oikea');

    const $muokkauslinkki = document.createElement('a');
    $muokkauslinkki.classList.add('nappi', 'nappi-p');
    $muokkauslinkki.href = 'muokkaa_harjoitus.php?id=' + harjoitus.harjoitusId;

    const $muokkausikoni = document.createElement('i');
    $muokkausikoni.classList.add('material-icons');
    $muokkausikoni.textContent = 'edit';

    const $poistolomake = document.createElement('form');
    $poistolomake.dataset.id = harjoitus.harjoitusId;
    $poistolomake.classList.add('poista-harjoitus-lomake');
    lisaaPoistaja($poistolomake);

    const $poistonappi = document.createElement('button');
    $poistonappi.type = 'submit';
    $poistonappi.classList.add('nappi-r');

    const $poistoikoni = document.createElement('i');
    $poistoikoni.classList.add('material-icons');
    $poistoikoni.textContent = 'delete_forever';

    $poistonappi.appendChild($poistoikoni);
    $poistolomake.appendChild($poistonappi)

    $muokkauslinkki.appendChild($muokkausikoni);

    $kontrollitDiv.appendChild($muokkauslinkki);
    $kontrollitDiv.appendChild($poistolomake);
    $kontrollitTd.appendChild($kontrollitDiv);

    $harjoitusTr.appendChild($nimiTd);
    $harjoitusTr.appendChild($kontrollitTd);

    $harjoitukset.appendChild($harjoitusTr);
  } // LISAA_HARJOITUS_ELEMENTTI_END


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
