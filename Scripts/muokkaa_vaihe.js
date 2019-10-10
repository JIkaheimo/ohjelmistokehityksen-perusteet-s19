(function () {
  const $lomake = document.querySelector('form#muokkauslomake');
  const $vaihe = document.querySelector('input#vaihe');
  const $nimi = document.querySelector('input#nimi');
  const $kuvaus = document.querySelector('textarea#kuvaus');
  const $ohjelinkki = document.querySelector('input#linkki');

  $lomake.addEventListener('submit', muokkaaVaihe);

  function muokkaaVaihe(event) {
    event.preventDefault();

    const body = {
      id: $vaihe.value,
      nimi: $nimi.value,
      kuvaus: $kuvaus.value,
      ohjelinkki: $ohjelinkki.value
    }

    request('./Api/vaiheet.php').put(
      body,
      function ilmoitaOnnistuminen(res) {
        console.log(res);
      },
      function ilmoitaVirhe(res) {
        console.error(res);
      }
    )
  }
})();