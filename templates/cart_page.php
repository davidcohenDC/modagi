<!-- shop icon -->
<script src="https://use.fontawesome.com/c560c025cf.js"></script>
<script src="<?php echo JS_FILE?>cart/jquery.cookie.js"></script>
<script src="<?php echo JS_FILE?>cart/cart_page.js"></script>
<script>
    function increaseQuantity(articleName) {
        var allArticle = jQuery.parseJSON(jQuery.cookie("<?php echo CART_COOKIE ?>"));
        allArticle.push(articleName);

        jQuery.removeCookie("<?php echo CART_COOKIE ?>");
        jQuery.cookie("<?php echo CART_COOKIE ?>", JSON.stringify(allArticle), {path: '/' });
        location.reload();
    }

    function decreaseQuantity(articleName) {
        var allArticle = jQuery.parseJSON(jQuery.cookie("<?php echo CART_COOKIE ?>"));
        var articleIndex = allArticle.indexOf(articleName);
        allArticle.splice(articleIndex, 1);

        jQuery.removeCookie("<?php echo CART_COOKIE ?>");
        jQuery.cookie("<?php echo CART_COOKIE ?>", JSON.stringify(allArticle), {path: '/' });
        location.reload();
    }

    function removeArticle(articleName) {
        var allArticle = jQuery.parseJSON(jQuery.cookie("<?php echo CART_COOKIE ?>"));
        allArticle.remove(articleName);

        jQuery.removeCookie("<?php echo CART_COOKIE ?>");
        jQuery.cookie("<?php echo CART_COOKIE ?>", JSON.stringify(allArticle), {path: '/' });
        location.reload();
    }
</script>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

<section class="shopping-cart">
    <div class="container">
        <div class="block-heading">
            <h2>Shopping Cart</h2>
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
                        <?php foreach($cart["articleDetails"] as $key => $article): ?> 
                        <div class="product">
                            <div class="row">
                                <div class="col-md-3">
                                    <img class="img-fluid mx-auto d-block image" src="<?php echo IMG_DIR.$article[0]["nome"].".jpg" ?>">
                                </div>
                                <div class="col-md-8">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-md-5 product-name">
                                                <div class="product-name">
                                                    <a href="#"><?php echo $article[0]["nome"] ?></a>
                                                    <div class="product-info">
                                                        <div>Colore: <span class="value">Bianco</span></div>
                                                        <div>Taglia: <span class="value">44.5</span></div>
                                                        <div>Genere: <span class="value">Uomo</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md quantity">
                                                <div class="input-group product-group">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-btn">
                                                            <input type="button" value="-" class="btn btn-danger" onclick="decreaseQuantity('<?php echo $article[0]["nome"] ?>')">
                                                        </div>
                                                    </div>
                                                    <div id="quantity" class="form-control product-quantity"><?php echo $article[1]?></div>
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-btn">
                                                            <input type="button" value="+" class="btn btn-success" onclick="increaseQuantity('<?php echo $article[0]["nome"] ?>')" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 price">
                                                <span><?php echo ($article[0]["prezzo"] * $article[1]) ?>€</span>
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
                        <h3>Summary</h3>
                        <div class="summary-item"><span class="text">Subtotal: </span><span class="price"><?php echo $cart["totalPrice"] ?>€</span></div>
                        <div class="summary-item"><span class="text">Discount: </span><span class="price">$0</span></div>
                        <div class="summary-item"><span class="text">Shipping: </span><span class="price">$0</span></div>
                        <div class="summary-item"><span class="text">Total: </span><span class="price"><?php echo $cart["totalPrice"] ?>€</span></div>
                        <button type="button" class="btn btn-primary btn-lg btn-block">Checkout</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</section>
