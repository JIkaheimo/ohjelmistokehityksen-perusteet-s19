(function () {
  // DOM-ELEMENTIT ===================================================================
  const $lomake = document.querySelector('#ohjelma-lomake');
  const $kayttaja = document.querySelector('#ohjelma-kayttaja');
  const $nimi = document.querySelector('#ohjelma-nimi');
  const $vaikeus = document.querySelector('#ohjelma-vaikeus');

  $lomake.addEventListener('submit', lisaaOhjelma);

  // LISAA_OHJELMA ================================================================
  function lisaaOhjelma(event) {
    event.preventDefault();

    // Tarkistetaan että ohjelmalla on sopiva nimi.
    const nimi = $nimi.value;

    if (nimi.length < 10) {
      ilmoitus.naytaVirhe('Ohjelman nimessä tulee olla vähintään 10 merkkiä.');
      ilmoitus.naytaLomakevirhe($nimi);
      return;
    }

    if (!nimi.onkoSallitutMerkit()) {
      ilmoitus.naytaVirhe('Nimi sisältää ei sallittuja merkkejä.');
      ilmoitus.naytaLomakevirhe($nimi);
      return;
    }

    const body = {
      kayttajatunnus: $kayttaja.value,
      nimi: nimi,
      vaikeustasoId: $vaikeus.value
    };

    // Lähetä POST-pyyntö uuden ohjelman lisäämiseksi
    request('./Api/ohjelmat.php').post(
      body,
      function siirryOhjelmanMuokkaukseen(res) {
        sessionStorage.setItem('viesti', 'Uusi ohjelma luotiin onnistuneesti!');
        window.location.href = 'muokkaa_ohjelma.php?id=' + res.ohjelmaId;
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );

  } // LISAA_OHJELMA_END
})();
