(function () {
  const $ohjelmaNimi = document.querySelector('input#ohjelma-nimi');
  const $ohjelmaSections = document.querySelectorAll('#kaikki-ohjelmat-container > .ohjelma');

  $ohjelmaNimi.addEventListener('keyup', function (evt) {
    const kirjaimet = evt.target.value;

    $ohjelmaSections.forEach(function ($section) {
      if ($section.dataset.ohjelma.toUpperCase().includes(kirjaimet.toUpperCase())) {
        $section.style.display = 'block';
      } else {
        $section.style.display = 'none';
      }
    })
  })
})()

