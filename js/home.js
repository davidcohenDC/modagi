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

$(function(){

    $('input[name=checkGenere]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"genere",+$(this).val());
        $url = location.href = $url;
        })

    $('input[name=checkMarca]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"marca",+$(this).val());
        $url = location.href = $url;

      })

      $('input[name=checkMateriale]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"materiale",+$(this).val());
        $url = location.href = $url;

      })

      $('input[name=checkColore]').on('change', function() {
        var $url = $(this).val();
        $url = updateQueryStringParameter(window.location.href,"colore",+$(this).val());
        $url = location.href = $url;

      })

});