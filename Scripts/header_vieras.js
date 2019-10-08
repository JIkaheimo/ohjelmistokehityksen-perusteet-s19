(function() {
  const $kirjautumislomake = document.querySelector('#kir-lomake');
  const $kayttajatunnus = document.querySelector('#kir-kayttajatunnus');
  const $salasana = document.querySelector('#kir-salasana');

  $kirjautumislomake.addEventListener('submit', kirjaudu);

  function kirjaudu(event) {
    event.preventDefault();

    const body = {
      kayttajatunnus: $kayttajatunnus.value,
      salasana: $salasana.value
    };

    request('./Api/kirjaudu.php').post(
      body,
      function onSuccess(res) {
        sessionStorage.setItem('viesti', res.viesti);
        window.location.href = 'index.php';
      },
      function onFail(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }
})();
