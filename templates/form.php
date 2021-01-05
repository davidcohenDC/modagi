<!-- for eye to show password -->
<script src="<?php echo JS_FILE ?>user/password-viewer.js"></script>

<div class="row">
    <div class="h2 my-5 col-12 text-center fw-bold">
        <?php echo $formParams["title"]; ?>
    </div>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
    <form method="POST" class="col-10 col-md-8 col-lg-6" enctype="multipart/form-data">

        <?php if (isset($templateParams["error"])) : ?>
            <div class="row">
                <div class="alert alert-danger my-3 text-center col-12" role="alert">
                    <div class="h2">
                        ERRORE
                    </div>
                    <p class="my-1 text-center">
                        <?php echo $templateParams["error"]; ?>
                    </p>
                </div>

            </div>
        <?php endif ?>

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