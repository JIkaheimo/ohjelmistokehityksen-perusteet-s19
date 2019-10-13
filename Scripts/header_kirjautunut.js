(function() {
  const $uloskirjautumislomake = document.querySelector(
    'form#uloskirjautumislomake'
  );

  $uloskirjautumislomake.addEventListener('submit', uloskirjaudu);

  function uloskirjaudu(event) {
    event.preventDefault();
    request('./Api/uloskirjaudu.php').post(
      null,
      function(res) {
        sessionStorage.setItem('viesti', 'Kiitos käynnistä!');
        window.location.href = 'index.php';
      },
      function(res) {
        ilmoitus.naytaVirhe(res.viesti);
      }
    );
  }
})();
