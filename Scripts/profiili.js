(function() {
  const $kayttajalomake = document.querySelector('#kayttajalomake');
  const $kayttajatunnus = document.querySelector('#kayttajatunnus');
  const $etunimi = document.querySelector('#etunimi');
  const $sukunimi = document.querySelector('#sukunimi');
  const $kuva = document.querySelector('#kuva');
  const $kuvaus = document.querySelector('#kuvaus');

  $kayttajalomake.addEventListener('submit', paivitaKayttaja);

  function paivitaKayttaja(event) {
    event.preventDefault();

    $kayttajalomake.submit();
  }
})();
