function addtoURl($url) {
    $url= $ulr+$url;
}


function updateQueryStringParameter(uri, key, value) {
    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
      return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
      return uri + separator + key + "=" + value;
    }
  }

  function removeParam(key, sourceURL) {
    var rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (var i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

$(function(){

  document.addEventListener("DOMContentLoaded", function(event) { 
    var scrollpos = localStorage.getItem('scrollpos');
    if (scrollpos) window.scrollTo(0, scrollpos);
});

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};

    $('input[name=checkGenere]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"genere",+$(this).val());
        $url = removeParam("pag",$url);
        $url = location.href = $url+"&pag=1";
        })

    $('input[name=checkMarca]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"marca",+$(this).val());
        $url = removeParam("pag",$url);
        $url = location.href = $url+"&pag=1";

      })

      $('input[name=checkMateriale]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"materiale",+$(this).val());
        $url = removeParam("pag",$url);
        $url = location.href = $url+"&pag=1";
        

      })

      $('input[name=checkColore]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"colore",+$(this).val());
        $url = removeParam("pag",$url);
        $url = location.href = $url+"&pag=1";

      })

});