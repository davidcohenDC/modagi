$(function(){
    $("li.nav-item").on("click", function(e) {
        e.preventDefault()
        
        $("li.active span").html("");
        $("li.active").removeClass("active");

        $(this).addClass("active");      
        $("li.active span").html("(current)");

        return true;
    });
});