(function () {
  const $kayttajat = document.querySelector('#kaikki-kayttajat-container');

  const $kayttajaNimi = document.querySelector('input#kayttaja-nimi');
  const $kayttajaSections = document.querySelectorAll('#kaikki-kayttajat-container > .kayttaja');

  $kayttajaNimi.addEventListener('keyup', function (evt) {
    const kirjaimet = evt.target.value;

    $kayttajaSections.forEach(function ($section) {
      if ($section.id.toUpperCase().includes(kirjaimet.toUpperCase())) {
        $section.style.display = 'block';
      } else {
        $section.style.display = 'none';
      }
    })
  })
})();
