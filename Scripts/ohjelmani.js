(function () {
  const $poistolomakkeet = document.querySelectorAll('.poista-ohjelma-lomake');

  for (let i = 0; i < $poistolomakkeet.length; i++) {
    lisaaPoistaja($poistolomakkeet[i]);
  }

  function lisaaPoistaja($lomake) {
    $lomake.addEventListener('submit', poistaOhjelma($lomake.dataset.id));
  }

  function poistaOhjelma(id) {
    return function (event) {
      event.preventDefault();

      const body = {
        id: id
      };

      request('./Api/ohjelmat.php').delete(
        body,
        function onSuccess(res) {
          const $ohjelma = document.querySelector('#ohjelma-' + id);
          $ohjelma.parentNode.removeChild($ohjelma);
          ilmoitus.naytaOnnistunut('Ohjelma poistettiin onnistuneesti!');
        },
        function onFail(res) {
          ilmoitus.naytaVirhe('Ohjelmaa ei pystytty poistamaan...');
        }
      );
    };
  }
})();
