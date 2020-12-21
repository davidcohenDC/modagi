<!--mdbimports-->
<link rel="stylesheet" href="<?php echo CSS_FILE ?>mdb.min.css">
<script src="<?php echo CSS_FILE ?>mdb.min.js"></script>

<!-- for eye to show password -->
<script src="<?php echo JS_FILE ?>password-viewer.js"></script>

<div class="row">
    <h1 class="fs-1 my-5 col-12 text-center fw-bold">
        <?php echo $formParams["title"]; ?>
    </h1>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
    <form method="POST" class="col-10 col-md-8 col-lg-6">


        <!--form content-->
        <?php
        if (isset($formParams["main"])) {
            require 'forms/' . $formParams["main"];
        }
        ?>

    </form>
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>