function increaseQuantity(articleId, articleSize) {
    $.ajax({
        type: "POST",
        data: { id: articleId , size: articleSize},
        url: "./ajaxFunction/increaseProduct.php"
    }).done(function(response) {
        //alert(response);
        var jsonData = JSON.parse(response);
        var articlePrice = jsonData.articlePrice;
        var articleNewQuantity = jsonData.articleNewQuantity;
        var articleOldQuantity = jsonData.articleOldQuantity;
        var newTotalPrice = jsonData.newTotalPrice;
        
        if(articleNewQuantity == articleOldQuantity) {
            //alert("Quantità presente nel magazzino insufficiente");
            showModal();
        }
        $("#C_"+ articleId + "_" + articleSize).text(articlePrice + "€");
        $("#Q_"+ articleId + "_" + articleSize).text(articleNewQuantity);
        $("#totalPrice").text(newTotalPrice + "€");
    });
}

function decreaseQuantity(articleId, articleSize) {
    $.ajax({
        type: "POST",
        data: { id: articleId , size: articleSize},
        url: "./ajaxFunction/decreaseProduct.php"
    }).done(function(response) {
        //alert(response);
        var jsonData = JSON.parse(response);
        var newTotalPrice = jsonData.newTotalPrice;
        if(Object.keys(jsonData).length > 1) {
            var articlePrice = jsonData.articlePrice;
            var articleQuantity = jsonData.articleQuantity;
            
            $("#C_"+ articleId + "_" + articleSize).text(articlePrice + "€");
            $("#Q_"+ articleId + "_" + articleSize).text(articleQuantity);
        }
        else {
            $("#P_"+ articleId + "_" + articleSize).remove();
            checkProductCount();
        }
        $("#totalPrice").text(newTotalPrice + "€");         
    });
}

function deleteProduct(articleId, articleSize) {
    $.ajax({
        type: "POST",
        data: { id: articleId , size: articleSize},
        url: "./ajaxFunction/deleteProduct.php"
    }).done(function(response) {
        //alert(response);
        var jsonData = JSON.parse(response);
        var newTotalPrice = jsonData.newTotalPrice;

        $("#P_"+ articleId + "_" + articleSize).remove();
        checkProductCount();

        $("#totalPrice").text(newTotalPrice + "€");
    });
}

function deleteAllProduct() {
    $.ajax({
        type: "POST",
        url: "./ajaxFunction/deleteAllProduct.php"
    }).done(function(response) {
        //alert(response);
        const newTotalPrice = 0;

        $(".product").remove();
        checkProductCount();

        $("#totalPrice").text(newTotalPrice + "€");         
    });
}

function checkProductCount() {
    var numProduct = $(".product").length;
    if(numProduct < 1) {
        $("#noProductAllert").show();
        $("#trashAllBtn").hide();
    }
    else {
        $("#noProductAllert").hide();
        $("#trashAllBtn").show();
    }
}

function showModal() {
    $("#modal").modal('show', {
        fadeDuration: 100
    });
}