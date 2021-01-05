<!--cart import for cards-->
<link rel="stylesheet" href="<?php echo CSS_FILE ?>cart/cart.css">
<!--status steps-->
<script src="<?php echo JS_FILE ?>user/order-status.js"></script>
<script src="<?php echo JS_FILE ?>user/forward-status.js"></script>

<div class="row">
    <div class="h1 my-5 col-12 text-center fw-bold">
        Ordini in sospeso
    </div>
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
                <div class="h2">
                    <?php echo $templateParams["noOrders"] ?>
                </div>
            </div>
        <?php else : ?>
            <?php $j = 0 ?>
            <!-- date -->
            <?php foreach ($templateParams["dates"] as $date) : ?>
                <section class="my-3">
                    <div class="h3 text-center">
                        <?php echo $date["data"] ?>
                    </div>
                    <?php foreach ($templateParams[$date["data"]] as $product) : ?>
                        <div class="product my-4 py-4 product-history">
                            <div class="row text-center">
                                <div class="h4 col-12">User: <?php echo $product["user"]; ?></div>
                                <div class="h4 col-12">Indirizzo: <?php echo $product["indirizzo"]; ?></div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3 col-lg-2 col-xl-3 my-4">
                                    <a href="product.php?prodotto=<?php echo $product["id"] ?>">
                                        <img class=" img-fluid mx-auto d-block image product-image" src="<?php echo IMG_DIR . $product["id"] . ".jpg" ?> " alt="<?php echo $product["nome"]; ?>" />
                                    </a>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 text-center">
                                    <div class="col-lg-12">
                                        <div class="my-2"></div>
                                        <!--empty space vertical-->
                                    </div>
                                    <div class="alert alert-<?php echo getOrderStatusColor($templateParams["stati"][$j]["statID"]); ?> my-3 text-center col-12" role="alert">
                                        <div class="h4">
                                            Stato Ordine:
                                        </div>
                                        <div class="my-1 text-center fw-bold">
                                            <div class="status">
                                                <?php echo $templateParams["stati"][$j]["stato"]; ?>
                                                <input type="hidden" class="for-<?php echo $j; ?>" value="<?php echo $templateParams["stati"][$j]["statID"]; ?>-<?php echo getOrderStatusColor($templateParams["stati"][$j]["statID"]); ?>" />
                                            </div>
                                        </div>

                                        <a href="vendor-action-page.php?action=12&order=<?php echo $product["orderID"] . "&status=" . $templateParams["stati"][$j]["statID"] . "&email=" . $product["email"]; ?>" class="btn btn-<?php echo getOrderStatusColor($templateParams["stati"][$j]["statID"]); ?> text-white">
                                            <span>Avanza Stato</span>
                                        </a>

                                    </div>

                                    <div class="text-center visual-status s-<?php echo $j; ?>">
                                        <!--package--><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icons['size'] ?>" height="<?php echo $icons['size'] ?>" fill="currentColor" class="bi bi-box-seam step-1" viewBox="0 0 16 16">
                                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7l-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                        </svg>
                                        <!--points--><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icons['size'] ?>" height="<?php echo $icons['size'] ?>" fill="currentColor" class="bi bi-three-dots step-2" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                        <!--truck--><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icons['size'] ?>" height="<?php echo $icons['size'] ?>" fill="currentColor" class="bi bi-truck step-2" viewBox="0 0 16 16">
                                            <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7zm1.294 7.456A1.999 1.999 0 0 1 4.732 11h5.536a2.01 2.01 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456zM12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12v4zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                        </svg>
                                        <!--points--><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icons['size'] ?>" height="<?php echo $icons['size'] ?>" fill="currentColor" class="bi bi-three-dots step-3" viewBox="0 0 16 16">
                                            <path d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" />
                                        </svg>
                                        <!--V tick--><svg xmlns="http://www.w3.org/2000/svg" width="<?php echo $icons['size'] ?>" height="<?php echo $icons['size'] ?>" fill="currentColor" class="bi bi-check-circle step-3" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>

                                </div>
                                <div class="col-md-5 col-lg-4 col-xl-4">
                                    <div class="info my-4">
                                        <div class="row text-center">
                                            <div class="col-11 product-name">
                                                <div class="product-name">
                                                    <div class="h4 card-title text-md-right"><?php echo $product["nome"] ?></div>
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
                        <?php $j++; ?>
                    <?php endforeach ?>
                </section>
                <hr />
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <div class="col-md-1 col-lg-2">
        <!--empty space-->
    </div>
</div>