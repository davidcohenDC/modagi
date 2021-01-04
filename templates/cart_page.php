<!-- shop icon -->
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<script src="<?php echo JS_FILE?>cart/jquery.cookie.js"></script>
<script src="<?php echo JS_FILE?>cart/cart_page.js"></script>
<script>
    $(function() {
        const phpCheck = <?php if(empty($cart["articleDetails"])) {echo "true";} else {echo "false";} ?>;
        if(phpCheck) {
            $("#noProductAllert").show();
            $("#trashAllBtn").hide();
        }
        else {
            $("#noProductAllert").hide();
            $("#trashAllBtn").show();
        }
    });

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
                alert("Quantità presente nel magazzino insufficiente");
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
</script>

<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<section class="shopping-cart">
    <div class="container">
        <div class="block-heading">
            <h2>Carrello</h2>
        </div>
        <div class="content">
            <div class="row">
                <div class="col-md-12 col-lg-8">
                    <div class="items">
                        <!-- ADVISE THAT THERE ARE NO PRODUCT IN CART -->
                        
                        <div id="noProductAllert" class="alert alert-warning">
                            Non ci sono articoli nel carrello. <a href="index.php" class="alert-link">Clicca qui per tornare gli acquisti!</a>
                        </div>
                        <!-- SHOW PRODUCT -->
                        <?php foreach($cart["articleDetails"] as $article): ?> 
                        <div id="<?php echo "P_" . $article["id"]."_".$article["taglia"] ?>" class="product">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-fluid mx-auto d-block image product-image" src="<?php echo IMG_DIR.$article["nome"].".jpg" ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-md-5 product-name">
                                                <div class="product-name">
                                                    <?php echo $article["nome"] ?>
                                                    <div class="product-info">
                                                        <div>Colore: <span class="value">Bianco</span></div>
                                                        <div>Taglia: <span class="value"><?php echo $article["taglia"] ?></span></div>
                                                        <div>Genere: <span class="value">Uomo</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md quantity">
                                                <div class="input-group product-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-btn">
                                                            <input type="button" value="-" class="btn btn-danger" 
                                                                onclick="decreaseQuantity('<?php echo $article["id"]."','".$article["taglia"] ?>')">
                                                        </div>
                                                    </div>
                                                    <div id="<?php echo "Q_" . $article["id"]."_".$article["taglia"] ?>" class="form-control product-quantity">
                                                        <?php echo $article["quantita"]?>
                                                    </div>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-btn">
                                                            <input type="button" value="+" class="btn btn-success" 
                                                                onclick="increaseQuantity('<?php echo $article["id"]."','".$article["taglia"] ?>')" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div id="<?php echo "C_" . $article["id"]."_".$article["taglia"] ?>" class="col-md-3 price product-price">
                                                <?php echo ($article["prezzo"] * $article["quantita"]) ?>€
                                            </div>
                                            <div class="col-md">
                                                <button class="btn trash-btn" onclick="deleteProduct('<?php echo $article["id"]."','".$article["taglia"] ?>')">
                                                    <i class="fa fa-trash"></i>        
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <!-- END SHOW PRODUCT -->
                    </div>
                    <button id="trashAllBtn" class="btn trash-btn" onclick="deleteAllProduct()">
                        Svuota carrello <i class="fa fa-trash"></i>        
                    </button>
                </div>
                <div class="col-md-12 col-lg-4">
                    <div class="summary">
                        <h3>Resoconto</h3>
                        <div class="summary-item"><span class="text">Totale: </span><span id="totalPrice" class="price"><?php echo $cart["totalPrice"] ?>€</span></div>
                        <button type="button" class="btn btn-primary btn-lg btn-block" onclick="location.href = 'checkout.php';">Checkout</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
