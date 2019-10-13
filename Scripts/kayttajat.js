(function () {

  const $kayttajaNimi = document.querySelector('input#kayttaja-nimi');
  const $kayttajaSections = document.querySelectorAll('#kaikki-kayttajat-container > .kayttaja');

  $kayttajaNimi.addEventListener('keyup', function (evt) {
    const kirjaimet = evt.target.value;

    for (let i = 0; i < $kayttajaSections.length; i++) {
      const $section = $kayttajaSections[i];
      if ($section.id.toUpperCase().includes(kirjaimet.toUpperCase())) {
        $section.style.display = 'block';
      } else {
        $section.style.display = 'none';
      }
    }
  })
})();
