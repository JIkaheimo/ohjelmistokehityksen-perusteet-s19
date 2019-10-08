(function() {
  const $suoritustaulu = document.querySelector('table#suoritustaulu');
  const $suoritusContainer = document.querySelector('tbody#suoritukset');
  const $poistolomakkeet = document.querySelectorAll('form.poista-suoritus');

  Array.from($poistolomakkeet).forEach(lisaaPoistaja);

  function lisaaPoistaja($poistolomake) {
    const id = $poistolomake.dataset.id;

    $poistolomake.addEventListener('submit', poistaSuoritus);

    function poistaSuoritus(event) {
      event.preventDefault();

      request('./Api/suoritukset.php').delete(
        { id: id },
        function poistaSuoritusTr(res) {
          ilmoitus.naytaOnnistunut(res.viesti);
          const $suoritus = document.querySelector('#suoritus-' + id);
          $suoritus.classList.add('piilotettu');
          setTimeout(function poistaSuoritus() {
            $suoritusContainer.removeChild($suoritus);
          }, 1000);

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
