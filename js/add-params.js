function containsFor(className) {
    return className.includes("for-");
}

$(function(){
    modalName = $(".modal-name");

    $(".add-button").on("click", function (e) {
        e.preventDefault();
        
        nome = $(this).attr("class").split(/\s+/).find(containsFor);
        nome = nome.split("-")[1];
        modalName.html(nome);
    });
});