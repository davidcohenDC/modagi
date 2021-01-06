<!-- for change buttons -->
<script src="<?php echo JS_FILE ?>user/change-data-selector.js"></script>

<div class="my-3 mx-2 ">
    <label for="name" class="form-label fw-bold"> Modifica Nome </label>
    <div id="name-group" class="input-group mb-3">
        <button id="change-name" class="select input-embedded">
            <span></span>
        </button>
        <input id="name" name="name" class="form-control col-12 fst-italic" type="text" placeholder="inserire nome" maxlength="20" />
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="surname" class="form-label fw-bold"> Modifica Cognome </label>
    <div id="surname-group" class="input-group mb-3">
        <button id="change-surname" class="select input-embedded ">
            <span></span>
        </button>
        <input id="surname" name="surname" class="form-control col-12 fst-italic" type="text" placeholder="inserire cognome" maxlength="20" />
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="address" class="form-label fw-bold"> Modifica Indirizzo </label>
    <div id="address-group" class="input-group mb-3">
        <button id="change-address" class="select input-embedded">
            <span></span>
        </button>
        <input id="address" name="address" class="form-control col-12 fst-italic" type="text" placeholder="inserire indirizzo" maxlength="40" />
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="username" class="form-label fw-bold"> Modifica Username </label>
    <div id="username-group" class="input-group mb-3">
        <button id="change-username" class="select input-embedded">
            <span></span>
        </button>
        <input id="username" name="username" class="form-control col-12 fst-italic" type="text" placeholder="inserire username" maxlength="20" />
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password" class="form-label fw-bold"> Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="p" class="form-control fst-italic password" type="password" placeholder="inserire la password" maxlength="20" required />
        <button type="button" id="eye" class=" eye input-embedded">
            <span id="icon" class="e-icon">
            </span>
        </button>
    </div>

</div>

<div class="row justify-content-md-center justify-content-lg-end">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Conferma Modifiche" />
    </div>
</div>