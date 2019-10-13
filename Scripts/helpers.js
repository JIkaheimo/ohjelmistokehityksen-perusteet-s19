(function () {
  String.prototype.onkoAlfanumeerinen = function () {
    const sallittu = /[^a-z\d]/i;
    return this.match(sallittu) == null;
  };

  String.prototype.onkoSallitutMerkit = function () {
    const sallittu = /[^a-z\däöüÄÖÜß,.:\-'"\s]/i;
    return this.match(sallittu) == null;
  }

  String.prototype.includes = function (str) {
    var returnValue = false;

    if (this.indexOf(str) !== -1) {
      returnValue = true;
    }

    return returnValue;
  }

  Date.prototype.onkoSallittu = function () {
    return this instanceof Date && !isNaN(this);
  }
})();
