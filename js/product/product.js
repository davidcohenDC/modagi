$(function(){

    $(window).bind("load", function() {
      let urlParams = new URLSearchParams(window.location.search);
      let prezzo = urlParams.get('prezzo');
      $('.multi-range').val(prezzo);
    });

    $('#formAddToCart').on('submit', function (e) {
      e.preventDefault();
      setTimeout(function() {
        $url = removeParam("modal",window.location.href);
        location.href = $url+"&taglia="+$('input[name=taglia]:checked').attr("id")+"&quantita="+ $("input[type='number']").val()+"&modal=on";
      },0);
      this.submit();
    });
    
    $('#formModifyProduct').on('submit', function (e) {
      e.preventDefault();
      let urlParams = new URLSearchParams(window.location.search);
      location.href = "vendor-action-page.php?action=8&product="+urlParams.get('prodotto');
    });

    $("input[name=taglia]").on("change", function(){
      $("input[type='number']").prop('max',$("input[name=taglia]").attr("id"));
    });

    if(location.search.split('modal=')[1]) {
      let urlParams = new URLSearchParams(window.location.search);
      if(urlParams.get('quantita') > 0 ) {
        $('#modalAbandonedCart').modal('show');
      }
    }

});
