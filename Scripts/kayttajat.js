(function() {
  const $kayttajat = document.querySelector('#kaikki-kayttajat-container');
  let kayttajat = null;

  let naytetytAlku = 0;
  let naytetytLoppu = 4;

  window.onscroll = function(ev) {
    if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight) {
      naytetytAlku = naytetytLoppu;
      naytetytLoppu = Math.max(naytetytLoppu + 4, kayttajat.length);

      kayttajat.slice(naytetytAlku, naytetytLoppu).forEach(naytaKayttaja);
    }
  };

  request('./Api/kayttajat.php').get(
    '',
    function onSuccess(res) {
      kayttajat = res.kayttajat;
      kayttajat.slice(0, naytetytLoppu).forEach(naytaKayttaja);
    },
    function onFail(res) {
      ilmoitus.naytaVirhe(res.viesti);
    }
  );

  const $nimi = document.querySelector('#kayttaja-nimi');
  $nimi.addEventListener('keyup', suodataNimella);

  function suodataNimella(event) {
    const nimi = event.target.value;
    const kayttajatNimella = kayttajat.filter(function(kayttaja) {
      return kayttaja.kayttajatunnus.includes(nimi);
    });

    while ($kayttajat.firstChild) {
      $kayttajat.removeChild($kayttajat.firstChild);
    }
    kayttajatNimella.slice(0, naytetytLoppu).forEach(naytaKayttaja);
  }

  function naytaKayttaja(kayttaja) {
    const $kayttaja = document.createElement('section');
    $kayttaja.classList.add('kayttaja', 'kayttaja-pieni', 'piilotettu');

    const $kuva = document.createElement('img');
    $kuva.classList.add('img');
    $kuva.src = kayttaja.kuva
      ? './Assets/Kayttajat/' + kayttaja.kuva
      : './Assets/kayttaja-placeholder.png';
    $kuva.alt = kayttaja.kayttajatunnus;

    const $div = document.createElement('div');
    const $nimi = document.createElement('h3');
    $nimi.textContent = kayttaja.kayttajatunnus;

    const $linkki = document.createElement('a');
    $linkki.classList.add('nappi', 'nappi-p');
    $linkki.textContent = 'PROFIILI';
    $linkki.href = 'kayttaja.php?id=' + kayttaja.kayttajatunnus;

    $div.appendChild($nimi);
    $div.appendChild($linkki);

    $kayttaja.appendChild($kuva);
    $kayttaja.appendChild($div);

    $kayttajat.appendChild($kayttaja);
    setTimeout(function naytaKayttaja() {
      $kayttaja.classList.remove('piilotettu');
    }, 100);
  }
})();
