(function() {
  const $poistolomakkeet = document.querySelectorAll('.poista-ohjelma-lomake');

  Array.from($poistolomakkeet).map(lisaaPoistaja);

  function lisaaPoistaja($lomake) {
    $lomake.addEventListener('submit', poistaOhjelma($lomake.dataset.id));
  }

  function poistaOhjelma(id) {
    return function(event) {
      event.preventDefault();

      const body = {
        id: id
      };

      request('./Api/ohjelmat.php').delete(
        body,
        function onSuccess(res) {
          const $ohjelma = document.querySelector('#ohjelma-' + id);
          $ohjelma.parentNode.removeChild($ohjelma);
          ilmoitus.naytaOnnistunut(res.viesti);
        },
        function onFail(res) {
          ilmoitus.naytaVirhe(res.viesti);
        }
      );
    };
  }
})();
