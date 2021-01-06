function findFor(className) {
    return className.includes("for-");
}

function findAction(className) {
    return className.includes("action-");
}

function findPrev(className){
    return className.includes("prev-");
}

$(function(){
    modalName = $(".modal-name");

    $(".add-button").on("click", function (e) {
        e.preventDefault();
        
        nome = $(this).attr("class").split(/\s+/).find(findFor);
        nome = nome.split("-")[1];
        modalName.html(nome);
    
        action = $(this).attr("class").split(/\s+/).find(findAction);
        action = action.split("-")[1];     

        prev = $(this).attr("class").split(/\s+/).find(findPrev);
        prev = prev.split("-")[1];    
        
        product = $("input[type='hidden']").val();
        
        $("a.modal-confirm").attr("href", ).replace("#", "vendor-action-page.php?action=" + String(action) + "#");
    });

    $("a.modal-confirm").on("click", function(e) {
        newValue = $("#new-value").val();

        if(newValue == ""){
            e.preventDefault();
        }

        if(prev == 8){
            $(this).attr("href", "vendor-action-page.php?action=" + String(action) + "&new-value=" + String(newValue) + "&prev=" + String(prev) + "&product=" + String(product));
        }else{
            $(this).attr("href","vendor-action-page.php?action=" + String(action) + "&new-value=" + String(newValue) + "&prev=" + String(prev));
        }
    })
});