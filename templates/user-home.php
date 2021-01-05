<div class="row my-5">
    <div class="h3 col-12 text-center fw-bold">
        Bentornato!
    </div>
    <div class="h2 col-12 text-center fw-bold">
        <?php echo $_SESSION["username"]; ?>
    </div>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>

    <!--main content-->
    <div class="col-10 col-md-8 col-lg-6">
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
        <div class="btn-group-vertical col-12 ">

            <?php if (isset($templateParams["userActions"])) {
                require("actions/" . $templateParams["userActions"]);
            } ?>
        </div>
    </div>

    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>