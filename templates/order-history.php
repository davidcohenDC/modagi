<!--cart import for cards-->
<link rel="stylesheet" href="<?php echo CSS_FILE ?>cart/cart.css">

<div class="row">
    <h1 class="fs-1 my-5 col-12 text-center fw-bold">
        I Miei Ordini
    </h1>
</div>

<div class="row justify-content-lg-center">
    <div class="col-md-1 col-lg-2">
        <!--empty space-->
    </div>

    <!--main content-->
    <div class="col-12 col-md-10 col-lg-8">
        <!-- if no orders -->
        <?php if (isset($templateParams["noOrders"])) : ?>
            <div class="alert alert-secondary text-center my-5" role="alert">
                <h2>
                    <?php echo $templateParams["noOrders"] ?>
                </h2>
                <p>
                    Iniziamo a fare compere <a href="index.php" class="fw-bold">cliccando qui!</a>
                </p>
            </div>
        <?php else : ?>

            <!-- date -->
            <?php foreach ($templateParams["dates"] as $date) : ?>
                <section class="my-3">
                    <h3 class="text-center">
                        <?php echo $date["data"] ?>
                    </h3>

                    <?php foreach ($templateParams[$date["data"]] as $product) : ?>

                        <!--//TODO: ADD ORDER STATUS -->

                        <div class="product my-4 py-4 product-history">
                            <div class="row">
                                <div class="col-md-3 my-4">
                                    <img class="img-fluid mx-auto d-block image product-image" src="<?php echo IMG_DIR . "/" . $product["nome"] . ".jpg" ?>">
                                </div>
                                <div class="col-md-4">
                                    <!--empty space-->
                                </div>
                                <div class="col-md-5">
                                    <div class="info">
                                        <div class="row">
                                            <div class="col-11 product-name">
                                                <div class="product-name mx-3">
                                                    <h4 class="card-title text-md-right"><?php echo $product["nome"] ?></h4>
                                                    <div class="product-info">
                                                        <ul class="list-group list-group-flush">
                                                            <li class="list-group-item text-md-right">Quantità: <span class="value"><?php echo $product["quantita"] ?></span></li>
                                                            <li class="list-group-item text-md-right">Materiale: <span class="value"><?php echo $product["materiale"] ?></span></li>
                                                            <li class="list-group-item text-md-right">Genere: <span class="value"><?php echo $product["genere"] ?></span></li>
                                                            <li class="list-group-item text-md-right">Colore: <span class="value"><?php echo $product["colore"] ?></span></li>
                                                            <li class="list-group-item text-md-right">Totale: <span class="value"><?php echo ($product["prezzo"] *  $product["quantita"]) ?></span>€</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </section>
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <div class="col-md-1 col-lg-2">
        <!--empty space-->
    </div>
</div>