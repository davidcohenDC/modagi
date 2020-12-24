<!-- for change buttons -->
<script src="<?php echo JS_FILE ?>change-data-selector.js"></script>

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
    <label for="username-group" class="form-label fw-bold"> Modifica Username </label>
    <div id="username-group" class="input-group mb-3">
        <button id="change-username" class="change input-embedded">
            <span></span>
        </button>
        <input id="username" name="username" class="form-control col-12 fst-italic" type="text" placeholder="inserire username" maxlength="20" />
        <div class="invalid-feedback">
            Inserire un username valido
        </div>
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="p" class="form-control fst-italic password" type="password" placeholder="inserire la password" maxlength="20" required />
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