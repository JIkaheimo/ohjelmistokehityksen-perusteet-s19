(function () {
  const $suoritustaulu = document.querySelector('table#suoritustaulu');
  const $suoritusContainer = document.querySelector('tbody#suoritukset');
  const $poistolomakkeet = document.querySelectorAll('form.poista-suoritus');

  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

  function lisaaPoistaja($poistolomake) {
    const id = $poistolomake.dataset.id;

    $poistolomake.addEventListener('submit', poistaSuoritus);

    function poistaSuoritus(event) {
      event.preventDefault();

      request('./Api/suoritukset.php').delete(
        { id: id },
        function poistaSuoritusTr(res) {
          ilmoitus.naytaOnnistunut('Suoritus poistettiin onnistuneesti!');
          const $suoritus = document.querySelector('#suoritus-' + id);
          $suoritus.classList.add('piilotettu');

          $suoritusContainer.removeChild($suoritus);

          // Poista itse taulu jos suorituksia ei ole jäljellä.
          if (document.querySelector('.suoritus-tr') == null) {
            $suoritustaulu.parentNode.removeChild($suoritustaulu);
          }
        },
        function naytaVirhe(res) {
          ilmoitus.naytaVirhe(res.viesti);
        }
      );
    }
  }
})();
