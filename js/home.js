function addtoURl($url) {
    $url= $ulr+$url;
}


$(function(){

    $('input[name=checkGenere]').on('change', function() {
        var $url = $(this).val();
        $url = location.href = "index.php?genere="+$(this).val();
        })

    $('input[name=checkMarca]').on('change', function() {
        var $url = $(this).val();
        $url = location.href = "index.php?marca="+$(this).val();

      })

      $('input[name=checkMateriale]').on('change', function() {
        var $url = $(this).val();
        $url = location.href = "index.php?materiale="+$(this).val();

      })

      $('input[name=checkColore]').on('change', function() {
        var $url = $(this).val();
        $url = location.href = "index.php?colore="+$(this).val();

      })

});