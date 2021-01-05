<div class="my-3 mx-2 ">
    <label for="old-password-group" class="form-label fw-bold"> Vecchia Password </label>
    <div id="old-password-group" class="input-group mb-3">
        <input id="old-password" name="old" class="form-control fst-italic password" type="password" placeholder="inserire la password da cambiare" minlength="6" maxlength="20" required />
        <button type="button" id="old-eye" class="eye input-embedded">
            <span id="old-icon" class="e-icon"></span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="new-password-group" class="form-label fw-bold"> Nuova Password </label>
    <div id="new-password-group" class="input-group mb-3">
        <input id="new-password" name="new" class="form-control fst-italic password" type="password" placeholder="inserire la nuova password" minlength="6" maxlength="20" required />
        <button type="button" id="new-eye" class="eye input-embedded">
            <span id="new-icon" class="e-icon">
            </span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="row justify-content-md-center justify-content-lg-end">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Conferma" />
    </div>
</div>