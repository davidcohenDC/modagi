function increaseQuantity(articleId, articleSize) {
    $.ajax({
        type: "POST",
        data: { id: articleId , size: articleSize},
        url: "./ajaxFunction/increaseProduct.php"
    }).done(function(response) {
        const jsonData = JSON.parse(response);
        const articlePrice = jsonData.articlePrice;
        const articleNewQuantity = jsonData.articleNewQuantity;
        const articleOldQuantity = jsonData.articleOldQuantity;
        const newTotalPrice = jsonData.newTotalPrice;
        
        if(articleNewQuantity == articleOldQuantity) {
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
        const jsonData = JSON.parse(response);
        const newTotalPrice = jsonData.newTotalPrice;
        if(Object.keys(jsonData).length > 1) {
            const articlePrice = jsonData.articlePrice;
            const articleQuantity = jsonData.articleQuantity;
            
            $("#C_"+ articleId + "_" + articleSize).text(articlePrice + "€");
            $("#Q_"+ articleId + "_" + articleSize).text(articleQuantity);
        }
        else {
            $("#cartCounter").text(parseInt($("#cartCounter").text()) - 1);
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
        $("#cartCounter").text(parseInt($("#cartCounter").text()) - 1);
        const jsonData = JSON.parse(response);
        const newTotalPrice = jsonData.newTotalPrice;

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
        $("#cartCounter").text("0");
        const newTotalPrice = 0;

        $(".product").remove();
        checkProductCount();

        $("#totalPrice").text(newTotalPrice + "€");         
    });
}

function checkProductCount() {
    const numProduct = $(".product").length;
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