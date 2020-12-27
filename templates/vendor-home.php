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
        <div class="btn-group-vertical col-12 ">
            <a href="vendor-action-page.php?action=1" class="my-3 btn btn-light fw-bold"> Aggiungi Articolo </a>
            <a href="vendor-action-page.php?action=7" class="my-3 btn btn-light fw-bold"> Aggiungi Promozione </a>
            <a href="user-action-page.php?action=2" class="my-3 btn btn-light fw-bold"> Modifica Dati Utente </a>
            <a href="user-action-page.php?action=3" class="my-3 btn btn-light fw-bold"> Modifica Password </a>
            <a href="user-action-page.php?action=0" class="my-3 btn btn-danger fw-bold"> Esci </a>
        </div>
    </div>

    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>