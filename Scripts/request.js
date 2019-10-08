const request = (function() {
  return function request(url) {
    return {
      get: ajax('GET', url),
      post: ajax('POST', url),
      put: ajax('PUT', url),
      delete: ajax('DELETE', url)
    };
  };

  function ajax(method, url) {
    return function(content, onSuccess, onFail) {
      if (method == 'GET') {
        if (content != null) {
          url = url + '?' + content;
        }
      }

      const xhr = new XMLHttpRequest();
      xhr.open(method, url, true);
      xhr.setRequestHeader('Content-Type', 'application/json;charset=UTF-8');

      xhr.onreadystatechange = function onStateChange() {
        // Onnistuessa kutsu onSuccess-callbackia
        if (
          xhr.readyState == 4 &&
          (xhr.status == 200 || xhr.status == 201 || xhr.status == 204)
        ) {
          let res = xhr.responseText;
          try {
            res = JSON.parse(res);
          } catch (err) {}

          onSuccess && onSuccess(res);

          // Epäonnistuessa kutsu onFail-callbackia
        } else if (xhr.readyState == 4) {
          onFail && onFail(JSON.parse(xhr.responseText));
        }
      };

      // Muutetaan POST, PUT, DELETE body data JSONiksi
      if (method == 'POST' || method == 'PUT' || method == 'DELETE') {
        xhr.send(JSON.stringify(content));
      } else {
        xhr.send();
      }
    };
  }
})();
