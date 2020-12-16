<div class="row">
    <h1 class="fs-1 my-5 col-12 text-center fw-bold">
        Registrazione
    </h1>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
    <form method="POST" class="col-10 col-md-8 col-lg-6" action="user-page.php">

        <div class="my-3 mx-2 ">
            <label for="name" class="form-label fw-bold"> Nome </label>
            <input id="name" name="name" class="form-control col-12 fst-italic" type="text" placeholder="inserire nome" maxlength="20" required />
            <div class="invalid-feedback">
                Inserire un nome valido
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="surname" class="form-label fw-bold"> Cognome </label>
            <input id="surname" name="surname" class="form-control col-12 fst-italic" type="text" placeholder="inserire cognome" maxlength="20" required />
            <div class="invalid-feedback">
                Inserire un cognome valido
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="address" class="form-label fw-bold"> Indirizzo </label>
            <input id="address" name="address" class="form-control col-12 fst-italic" type="text" placeholder="inserire cognome" maxlength="40" required />
            <div class="invalid-feedback">
                Inserire un indirizzo valido
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="username" class="form-label fw-bold"> Username </label>
            <input id="username" name="username" class="form-control col-12 fst-italic" type="text" placeholder="inserire username" maxlength="20" required />
            <div class="invalid-feedback">
                Username non valido
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="password" class="form-label fw-bold"> Password </label>
            <input id="password" name="password" class="form-control col-12 fst-italic" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
            <div class="invalid-feedback">
                Password troppo corta: MINIMO 8 CARATTERI!
            </div>
        </div>

        <?php if (isset($templateParams["error"])) : ?>
            <p class="fs-3 my-5 col-12 text-center fw-bold text-danger">
                <?php echo $templateParams["error"]; ?>
            </p>
        <?php endif ?>

        <div class="row justify-content-md-center justify-content-lg-end">
            <div class="my-3 mx-2 col-md-10 col-lg-8">
                <input type="submit" class="btn btn-light col-12 fw-bold" value="Registrati" onclick="" />
            </div>
        </div>

    </form>
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>