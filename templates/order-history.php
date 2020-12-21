<!--mdbimports-->
<link rel="stylesheet" href="<?php echo CSS_FILE ?>mdb.min.css">
<script src="<?php echo CSS_FILE ?>mdb.min.js"></script>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>

    <!--main content-->
    <div class="col-10 col-md-8 col-lg-6">
        <!-- if no orders -->
        <?php if (isset($templateParams["noOrders"])) : ?>
            <div class="alert alert-secondary my-5" role="alert">
                <h2>
                    <?php echo $templateParams["noOrders"] ?>
                </h2>
                <p>
                    Iniziamo a fare compere <a href="index.php" class="fw-bold">cliccando qui!</a>
                </p>
            </div>
        <?php else : ?>
            <!-- date -->
            <?php foreach ($templateParams["date"] as $date) : ?>
                <section class="my-3">
                    <h3>
                        <?php echo $date ?>
                    </h3>

                    <?php foreach ($templateParams["products"][$date] as $productData) : ?>
                        <!-- products in that date -->
                        <!-- img -->
                        <!-- name -->
                        <!-- quantity -->
                        <!-- price -->
                    <?php endforeach ?>
                </section>
            <?php endforeach ?>
        <?php endif ?>
    </div>

    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>