<div class="row my-5">
    <div class="fs-2 col-12 text-center fw-bold">
        Bentornato!
    </div>
    <div class="fs-1 col-12 text-center fw-bold">
        <?php echo $_SESSION["username"]; ?>
    </div>
    </h1>
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
                    <h2>
                        ERRORE
                    </h2>
                    <p class="my-1 text-center">
                        <?php echo $templateParams["error"]; ?>
                    </p>
                </div>

            </div>
        <?php endif ?>
        <div class="btn-group-vertical col-12 ">
            <a href="user-action-page.php?action=1" class="my-3 btn btn-light fw-bold"> I miei Ordini </a>
            <a href="user-action-page.php?action=2" class="my-3 btn btn-light fw-bold"> Modifica Dati Utente </a>
            <a href="user-action-page.php?action=3" class="my-3 btn btn-light fw-bold"> Modifica Password </a>
            <a href="user-action-page.php?action=0" class="my-3 btn btn-danger fw-bold"> Esci </a>
            <a href="user-action-page.php?action=-1" class="my-3 btn btn-dark fw-bold"> Cancella Account </a>
        </div>
    </div>

    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>