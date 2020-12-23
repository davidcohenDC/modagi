function findFor(className) {
    return className.includes("for-");
}

function findAction(className) {
    return className.includes("action-");
}

$(function(){
    modalName = $(".modal-name");
    action = 1;

    $(".add-button").on("click", function (e) {
        e.preventDefault();
        
        nome = $(this).attr("class").split(/\s+/).find(findFor);
        nome = nome.split("-")[1];
        modalName.html(nome);
    
        action = $(this).attr("class").split(/\s+/).find(findAction);
        action = action.split("-")[1];     

        $("a.modal-confirm").attr("href", ).replace("#", "vendor-action-page.php?action=" + String(action) + "#");
    });

    $("a.modal-confirm").on("click", function(e) {
        newValue = $("#new-value").val();

        if(newValue == ""){
            e.preventDefault()
        }

        $(this).attr("href", "vendor-action-page.php?action=" + String(action) + "&new-value=" + String(newValue));
    })
});