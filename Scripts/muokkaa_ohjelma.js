/**
 * MUOKKAA_OHJELMA (muokkaa_ohjelma.php)
 */

(function () {
  //======= DOM-ELEMENTIT ====================================================

  const $ohjelmalomake = document.querySelector('form#ohjelma-lomake');
  const $ohjelmaKayttaja = document.querySelector('input#ohjelma-kayttaja');
  const $ohjelmaId = document.querySelector('input#ohjelma-id');
  const $ohjelmaNimi = document.querySelector('input#ohjelma-nimi');
  const $ohjelmaVaikeustasoId = document.querySelector(
    'select#ohjelma-vaikeustasoId'
  );

  const $harjoituslomake = document.querySelector('form#harjoitus-lomake');
  const $harjoitusOhjelma = document.querySelector('input#harjoitus-ohjelma');
  const $harjoitusNimi = document.querySelector('input#harjoitus-nimi');

  const $poistolomakkeet = document.querySelectorAll(
    'form.poista-harjoitus-form'
  );

  // Toteutetaan muokkaa_ohjelma.php-sivun funktionaalisuus listenereillä.
  $ohjelmalomake.addEventListener('submit', muokkaaOhjelma);
  $harjoituslomake.addEventListener('submit', lisaaHarjoitus);

  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

  //======== OHJELMAN TIETOJEN MUOKKAUS ======================================
  function muokkaaOhjelma(event) {
    /**
     * muokkaaOhjelma - Huolehtii muokatun ohjelman tietojen lähetyksestä APIin,
     * sekä tulostaa pyynnön onnistumisen/epäonnistumisen.
     */

    // Estetään lomakkeen submitointi.
    event.preventDefault();

    // Haetaan ja muodostetaan tarvittava pyynnön runko ohjelman muokkaamiseksi.
    const body = {
      id: $ohjelmaId.value,
      kayttajatunnus: $ohjelmaKayttaja.value,
      nimi: $ohjelmaNimi.value,
      vaikeustasoId:
        $ohjelmaVaikeustasoId.options[$ohjelmaVaikeustasoId.selectedIndex].value
    };

    // Lähetetään PUT-pyyntö Apille, joka suorittaa ohjelman muokkaamisen.
    request('./Api/ohjelmat.php').put(
      body,
      function onSuccess(res) {
        ilmoitus.naytaOnnistunut('Ohjelma päivitettiin onnistuneesti!');
      },
      function onFail(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  } // END

  //======== UUDEN HARJOITUKSEN LISÄYS =======================================
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
      function onSuccess(res) {
        sessionStorage.setItem('viesti', 'Harjoituksen lisäys onnistui!');
        window.location.href = '#harjoitukset';
        //location.reload(true);
      },
      function onFail(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  } // END

  //========= HARJOITUSTEN POISTO =============================================

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
        function onSuccess(res) {
          ilmoitus.naytaOnnistunut('Harjoitus poistettu onnistuneesti!');
        },
        ilmoitus.naytaVirhe
      );
    };
  } // END
})();
