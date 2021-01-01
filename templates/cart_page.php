<!-- shop icon -->
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<script src="<?php echo JS_FILE?>cart/jquery.cookie.js"></script>
<script src="<?php echo JS_FILE?>cart/cart_page.js"></script>
<script>
    function increaseQuantity(articleId, articleSize) {
        var allArticle = jQuery.parseJSON(jQuery.cookie("<?php echo CART_COOKIE ?>"));
        var thisArticle = articleId + "|" + articleSize;
        $.ajax({
            type: "POST",
            data: { id: articleId , size: articleSize},
            url: "./ajaxFunction/increaseProduct.php"
        }).done(function(response) {
            //alert(response);
            var jsonData = JSON.parse(response);
            var articlePrice = jsonData.articlePrice;
            var articleQuantity = jsonData.articleQuantity;
            var newTotalPrice = jsonData.newTotalPrice;
            
            $("#P_"+ articleId + "_" + articleSize).text(articlePrice + "€");
            $("#Q_"+ articleId + "_" + articleSize).text(articleQuantity);
            $("#totalPrice").text(newTotalPrice + "€");
        });
    }

    function decreaseQuantity(articleId, articleSize) {
        var allArticle = jQuery.parseJSON(jQuery.cookie("<?php echo CART_COOKIE ?>"));
        var thisArticle = articleId + "|" + articleSize;
        
        $.ajax({
            type: "POST",
            data: { id: articleId , size: articleSize},
            url: "./ajaxFunction/decreaseProduct.php"
        }).done(function(response) {
            //alert(response);
            var jsonData = JSON.parse(response);
            var articlePrice = jsonData.articlePrice;
            var articleQuantity = jsonData.articleQuantity;
            var newTotalPrice = jsonData.newTotalPrice;
            
            $("#P_"+ articleId + "_" + articleSize).text(articlePrice + "€");
            $("#Q_"+ articleId + "_" + articleSize).text(articleQuantity);
            $("#totalPrice").text(newTotalPrice + "€");
        });
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
                        <?php if(empty($cart["articleDetails"])): ?>
                            <div class="alert alert-warning">
                                Non ci sono articoli nel carrello. <a href="index.php" class="alert-link">Clicca qui per tornare gli acquisti!</a>
                            </div>
                        <?php endif ?>
                        <!-- SHOW PRODUCT -->
                        <?php foreach($cart["articleDetails"] as $article): ?> 
                        <div class="product">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-fluid mx-auto d-block image product-image" src="<?php echo IMG_DIR.$article["nome"].".jpg" ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-md-5 product-name">
                                                <div class="product-name">
                                                    <a href="#"><?php echo $article["nome"] ?></a>
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
                                            <div class="col-md-3 price">
                                                <span id="<?php echo "P_" . $article["id"]."_".$article["taglia"] ?>">
                                                    <?php echo ($article["prezzo"] * $article["quantita"]) ?>€
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <!-- END SHOW PRODUCT -->
                    </div>
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
