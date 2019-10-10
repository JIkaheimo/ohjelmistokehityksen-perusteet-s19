(function () {
  String.prototype.onkoAlfanumeerinen = function () {
    const sallittu = /[^a-z\d]/i;
    return this.match(sallittu) == null;
  };

  String.prototype.onkoSallitutMerkit = function () {
    const sallittu = /[^a-z\däöüÄÖÜß,.:'"\s]/i;
    return this.match(sallittu) == null;
  }
})();
