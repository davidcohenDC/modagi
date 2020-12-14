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

<div class="card shopping-cart">
    <div class="card-header bg-dark text-light">
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
        Shipping cart
        <a href="" class="btn btn-outline-info btn-sm pull-right">Continuie shopping</a>
        <div class="clearfix"></div>
    </div>

    <div class="card-body">
        <!-- PRODUCT -->
        <?php foreach($cart["articleDetails"] as $key => $article): ?> 
        <div class="row">
            <div class="col-12 col-sm-12 col-md-2 text-xs-center">
                <img class="img-responsive" src="<?php echo IMG_DIR.$article[0]["nome"].".jpg" ?>" alt="prewiew" width="120" height="120">
            </div>
            <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6">
                <h4 class="product-name"><strong><?php echo $article[0]["nome"] ?></strong></h4>
                <h4>
                    <small><?php echo $article[0]["descrizione"] ?></small>
                </h4>
            </div>
            <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row">
                <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                    <h6><strong><?php echo ($article[0]["prezzo"] * $article[1]) ?><span class="text-muted">€</span></strong></h6>
                </div>
                <div class="col-4 col-sm-4 col-md-4">
                    <div class="quantity">
                        <input type="button" value="+" class="plus" onclick="increaseQuantity('<?php echo $article[0]["nome"] ?>')" >
                        <input type="number" step="1" max="99" min="1" value="<?php echo $article[1]?>" title="Qty" class="qty" size="4">
                        <input type="button" value="-" class="minus" onclick="decreaseQuantity('<?php echo $article[0]["nome"] ?>')">
                    </div>
                </div>
                <div class="col-2 col-sm-2 col-md-2 text-xs-right">
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeArticle('<?php echo $article[0]["nome"] ?>')">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
        <hr>
        <?php endforeach ?>
        <!-- END PRODUCT -->

        <div class="pull-right">
            <a href="" class="btn btn-outline-secondary pull-right">Update shopping cart</a>
        </div>
    </div>

    <div class="card-footer">
        <div class="coupon col-md-5 col-sm-5 no-padding-left pull-left">
            <div class="row">
                <div class="col-6">
                    <input type="text" class="form-control" placeholder="cupone code">
                </div>
                <div class="col-6">
                    <input type="submit" class="btn btn-secondary" value="Use cupone">
                </div>
            </div>
        </div>
        <div class="pull-right" style="margin: 10px">
            <a href="" class="btn btn-success pull-right">Checkout</a>
            <div class="pull-right" style="margin: 5px">
                Total price: <b><?php echo $cart["totalPrice"] ?>€ </b>
            </div>
        </div>
    </div>
</div>
