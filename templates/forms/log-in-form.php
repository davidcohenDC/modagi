<?php if (isset($_SESSION["registrationSuccess"]) && $_SESSION["registrationSuccess"] == 1) : ?>
    <div class="row">
        <div class="alert alert-success my-3 text-center" role="alert">
            <h2>
                CONGRATULAZIONI!
            </h2>
            <p class="my-1 text-center">
                La registrazione è avventua con successo.
            </p>
        </div>

    </div>

    <?php unset($_SESSION["registrationSuccess"]); ?>
<?php endif ?>

<div class="my-3 mx-2 ">
    <label for="email" class="form-label fw-bold"> E-mail </label>
    <input id="email" name="email" class="form-control col-12 fst-italic" type="email" placeholder="inserire username" required />
    <div class="invalid-feedback">
        email non valida
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="password" class="form-control fst-italic password" type="password" placeholder="inserire password" minlength="3" maxlength="20" required />
        <button id="eye" class=" eye input-embedded">
            <span id="icon" class="icon">
            </span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="row justify-content-md-center justify-content-lg-end">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Log In" />
    </div>
</div>

<div class="my-4 text-end">
    <a href="registration-page.php">Non hai un Account? Registrati!</a>
</div>