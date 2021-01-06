$(function(){

    $("#carouselPromotion").carousel({
      interval: 3500
    });

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
      let url = $(this).val();
      $(".final-value").html($(this).val());
      url = updateQueryStringParameter(window.location.href,"prezzo",+$(this).val());
      url = removeParam("pag",url);
      url = location.href = url+"&pag=1";

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
});
