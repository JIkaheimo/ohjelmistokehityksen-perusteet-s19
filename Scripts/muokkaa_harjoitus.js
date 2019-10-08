(function() {
  // DOM-ELEMENTIT ====================================================
  const $harjoituslomake = document.querySelector('form#harjoituslomake');
  const $vaihelomake = document.querySelector('form#vaihelomake');
  const $vaiheHarjoitus = document.querySelector('input#vaihe-harjoitus');
  const $vaiheNimi = document.querySelector('input#vaihe-nimi');

  // LISTENERIT ========================================================
  $vaihelomake.addEventListener('submit', uusiVaihe);

  function uusiVaihe(event) {
    event.preventDefault();

    const body = {
      harjoitusId: $vaiheHarjoitus.value,
      nimi: $vaiheNimi.value
    };

    request('./Api/vaiheet.php').post(
      body,
      function(res) {
        console.log(res);
      },
      function(res) {
        console.error(res);
      }
    );
  }
})();
