
function updateQueryStringParameter(uri, key, value) {
    const re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    const separator = uri.indexOf('?') !== -1 ? "&" : "?";
    if (uri.match(re)) {
      return uri.replace(re, '$1' + key + "=" + value + '$2');
    }
    else {
      return uri + separator + key + "=" + value;
    }
  }

  function removeParam(key, sourceURL) {
    let rtn = sourceURL.split("?")[0],
        param,
        params_arr = [],
        queryString = (sourceURL.indexOf("?") !== -1) ? sourceURL.split("?")[1] : "";
    if (queryString !== "") {
        params_arr = queryString.split("&");
        for (let i = params_arr.length - 1; i >= 0; i -= 1) {
            param = params_arr[i].split("=")[0];
            if (param === key) {
                params_arr.splice(i, 1);
            }
        }
        rtn = rtn + "?" + params_arr.join("&");
    }
    return rtn;
}

function updatePage(param, val, url) {
  const urlParams = new URLSearchParams(window.location.search);
  url = updateQueryStringParameter(url,param,val);
  if(urlParams.get('pag') > 0) {
    url = removeParam("pag",url);
    return updateQueryStringParameter(url,"pag",1);
  } else {
    return url;
  }
}

$(function(){

    $('input[name=checkGenere]').on('change', function() {
        let url = updatePage("genere", $(this).val(), window.location.href);
        location.href = url;
    });

    $('input[name=checkMarca]').on('change', function() {
      let url = updatePage("marca", $(this).val(), window.location.href);
      location.href = url;

    });

    $('input[name=checkMateriale]').on('change', function() {
      let url = updatePage("materiale", $(this).val(), window.location.href);
      location.href = url; 
    });

    $('input[name=checkColore]').on('change', function() {
      let url = updatePage("colore", $(this).val(), window.location.href);
      location.href = url;
    });

    $('input[name=checkTaglia]').on('change', function() {
      let url = updatePage("taglia", $(this).val(), window.location.href);
      location.href = url;
    });

    $('.multi-range').on('change', function() {
      let $url = $(this).val();
      $(".final-value").html($(this).val());
      $url = updateQueryStringParameter(window.location.href,"prezzo",+$(this).val());
      $url = removeParam("pag",$url);
      $url = location.href = $url+"&pag=1";

    })

      $('button[name=btnDelete]').on('click', function() {
        location.href = "index.php";
        console.log("ciao");

      })
      
      
      $('.multi-range').on('input', function() {
        $(this).next('.range-value').html(this.value);
      });

      $(".link-table").on("click", function(){
        const arrow =  $("span",this);
        if(arrow.hasClass("fa-arrow-right")) {
          arrow.removeClass("fa-arrow-right");
          arrow.fadeOut(90,function (){
            arrow.addClass("fa-arrow-down");
            arrow.fadeIn("fast");
          });
        } else {
          arrow.removeClass("fa-arrow-down");
          arrow.fadeOut(90,function (){
            arrow.addClass("fa-arrow-right");
            arrow.fadeIn("fast");
          });
      }
      });

      $(window).bind("load", function() {
        let urlParams = new URLSearchParams(window.location.search);
        let prezzo = urlParams.get('prezzo');
        $('.multi-range').val(prezzo);
     });


    $('#formAddToCart').on('submit', function (e) {
      e.preventDefault();
      setTimeout(function() {
        $url = removeParam("modal",window.location.href);
        location.href = $url+"&taglia="+$('input[name=taglia]:checked').val()+"&quantita="+ $("input[type='number']").val()+"&modal=on";
      },0);
      this.submit();

    });
    
    $('#formModifyProduct').on('submit', function (e) {
      e.preventDefault();
      let urlParams = new URLSearchParams(window.location.search);
      location.href = "vendor-action-page.php?action=8&prodotto="+urlParams.get('prodotto');
    });

    $("input[name=taglia]").on("change", function(){
      $("input[type='number']").prop('max',$("input[name=taglia]").attr("id"));
    });

    
    if(location.search.split('modal=')[1]) {
      let urlParams = new URLSearchParams(window.location.search);
      if(urlParams.get('quantita') > 0) {
        $('#modalAbandonedCart').modal('show');
      } else {
        $('#modalProduct').modal('show');
      }

    }
});
