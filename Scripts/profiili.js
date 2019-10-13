(function () {
  const $kayttajalomake = document.querySelector('form#kayttajalomake');

  $kayttajalomake.addEventListener('submit', paivitaKayttaja, false);

  function paivitaKayttaja(event) {
    event.preventDefault();

    const data = new FormData($kayttajalomake);

    request('./Api/kayttajat.php').post(
      data,
      function naytaOnnistunut(res) {
        ilmoitus.naytaOnnistunut('Tiedot päivitettiin onnistuneesti!');
      },
      function naytaVirhe(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }, false
    )
  }
})();
