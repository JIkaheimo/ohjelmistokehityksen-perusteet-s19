(function() {
  const $lomake = document.querySelector('#ohjelma-lomake');
  const $kayttaja = document.querySelector('#ohjelma-kayttaja');
  const $nimi = document.querySelector('#ohjelma-nimi');
  const $vaikeus = document.querySelector('#ohjelma-vaikeus');

  $lomake.addEventListener('submit', lisaaOhjelma);

  function lisaaOhjelma(event) {
    event.preventDefault();

    const body = {
      kayttajatunnus: $kayttaja.value,
      nimi: $nimi.value,
      vaikeustasoId: $vaikeus.value
    };

    request('./Api/ohjelmat.php').post(
      body,
      function onSuccess(res) {
        sessionStorage.setItem('viesti', res.viesti);
        //window.location.href = 'muokkaa_ohjelma.php?id=' + res.id;
      },
      function onFail(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }
})();
