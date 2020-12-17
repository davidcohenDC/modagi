<!-- for eye to show password -->
<script src="<?php echo JS_FILE ?>password-viewer.js"></script>
<!-- for change buttons -->
<script src="<?php echo JS_FILE ?>change-data-selector.js"></script>


<div class="row">
    <h1 class="fs-1 my-5 col-12 text-center fw-bold">
        Modifica Dati Utente
    </h1>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
    <form method="POST" class="col-10 col-md-8 col-lg-6">

        <div class="my-3 mx-2 ">
            <label for="name-group" class="form-label fw-bold"> Modifica Nome </label>
            <div id="name-group" class="input-group mb-3">
                <button id="change-name" class="change input-embedded">
                    <span></span>
                </button>
                <input id="name" name="name" class="form-control col-12 fst-italic" type="text" placeholder="inserire nome" maxlength="20" />
                <div class="invalid-feedback">
                    Inserire un nome valido
                </div>
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="surname-group" class="form-label fw-bold"> Modifica Cognome </label>
            <div id="surname-group" class="input-group mb-3">
                <button id="change-surname" class="change input-embedded ">
                    <span></span>
                </button>
                <input id="surname" name="surname" class="form-control col-12 fst-italic" type="text" placeholder="inserire cognome" maxlength="20" />
                <div class="invalid-feedback">
                    Inserire un cognome valido
                </div>
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="address-group" class="form-label fw-bold"> Modifica Indirizzo </label>
            <div id="address-group" class="input-group mb-3">
                <button id="change-address" class="change input-embedded">
                    <span></span>
                </button>
                <input id="address" name="address" class="form-control col-12 fst-italic" type="text" placeholder="inserire indirizzo" maxlength="40" />
                <div class="invalid-feedback">
                    Inserire un indirizzo valido
                </div>
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="password-group" class="form-label fw-bold"> Password </label>
            <div id="password-group" class="input-group mb-3">
                <input id="password" name="old-password" class="form-control fst-italic password" type="password" placeholder="inserire la password" minlength="6" maxlength="20" required />
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
                <input type="submit" class="btn btn-light col-12 fw-bold" value="Conferma Modifiche" />
            </div>
        </div>

        <?php if (isset($templateParams["error"])) : ?>
            <p class="fs-3 my-5 col-12 text-center fw-bold text-danger">
                <?php echo $templateParams["error"]; ?>
            </p>
        <?php endif ?>

    </form>

    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
</div>