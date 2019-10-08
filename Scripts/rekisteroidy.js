(function() {
  // DOM-ELEMENTIT ================================================
  const $lomake = document.querySelector('#rek-lomake');
  const $kayttajatunnus = document.querySelector('#rek-kayttajatunnus');
  const $salasana = document.querySelector('#rek-salasana');
  const $salasana2 = document.querySelector('#rek-salasana-2');

  $lomake.addEventListener('submit', onSubmit);

  // LISTENERITT ===================================================
  function onSubmit(evt) {
    evt.preventDefault();

    // Haetaan lomakkeen arvot
    const kayttajatunnus = $kayttajatunnus.value;
    const salasana = $salasana.value;
    const salasana2 = $salasana2.value;

    // Tarkistetaan arvot
    if (!tarkistaKayttajatunnus(kayttajatunnus)) return;
    if (!tarkistaSalasana(salasana)) return;
    if (!vahvistaSalasanat(salasana, salasana2)) return;

    // Kootaan ja lähetetään tiedot rekisteröintikäsittelijälle
    const body = {
      kayttajatunnus: kayttajatunnus,
      salasana: salasana
    };

    request('./Api/rekisteroidy.php').post(
      body,
      function siirryHallintapaneeliin(res) {
        sessionStorage.setItem('viesti', 'Rekisteröityminen onnistui!');
        window.location.href = 'index.php';
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }

  /* VALIDITY CHECKERS ============================================== */

  function tarkistaKayttajatunnus(kayttajatunnus) {
    // Varmistetaan että käyttäjätunnuksen pituus on > 7.
    if (kayttajatunnus.length < 8) {
      ilmoitus.naytaVirhe(
        'Käyttäjätunnuksen tulee olla vähintään 8 merkkiä...'
      );
      ilmoitus.naytaLomakevirhe($kayttajatunnus);
      return false;
    }

    // Varmistetaan ettei käyttäjätunnus sisällä erikoismerkkejä.
    if (!kayttajatunnus.onkoAlfanumeerinen()) {
      ilmoitus.naytaVirhe(
        'Käyttäjätunnus voi sisältää vain kirjaimia ja numeroita.'
      );
      ilmoitus.naytaLomakevirhe($kayttajatunnus);
      return false;
    }
    return true;
  }

  function tarkistaSalasana(salasana) {
    // Varmistetaan että salasanan piituus on > 7
    if (salasana.length < 8) {
      ilmoitus.naytaVirhe('Salasanan tulee olla vähintään 8 merkkiä...');
      ilmoitus.naytaLomakevirhe($salasana);
      return false;
    }
    return true;
  }

  function vahvistaSalasanat(salasana, salasana2) {
    // Varmista että salasanat ovat samat.
    if (salasana !== salasana2) {
      ilmoitus.naytaVirhe('Antamasi salasanat eivät täsmää...');
      ilmoitus.naytaLomakevirhe($salasana);
      ilmoitus.naytaLomakevirhe($salasana2);
      return false;
    }
    return true;
  }
})();
