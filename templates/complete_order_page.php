<script type="text/javascript">

const delay = 1000;
const redirectTimeout = 0;
const url = "index.php";

var redirctCounter = 5;
$(function() {
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

</script>

<div class="shadow p-3 mb-5 bg-white rounded">
    Acquisto avvenuto con successo,
    <div id="redirectBox">verrai reindirizzato alla pagina principale tra 5 secondi...</div>
</div>
