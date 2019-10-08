(function() {
  String.prototype.onkoAlfanumeerinen = function() {
    const sallittu = /[^a-z\d]/i;
    return this.match(sallittu) == null;
  };
})();
