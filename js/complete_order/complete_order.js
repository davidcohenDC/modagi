const delay = 1000;
const redirectTimeout = 0;
const url = "index.php";

let redirctCounter = 5;
$(function() {
    $("#cartCounter").text("0");
    window.setInterval(function(){
        redirctCounter = redirctCounter - 1;
        if(redirctCounter <= redirectTimeout) {
            window.location.replace(url);
        }
        else {
            $("#redirectBox").text("Verrai reindirizzato alla pagina principale tra " + redirctCounter + " secondi...");
        }
        
    }, delay);
});