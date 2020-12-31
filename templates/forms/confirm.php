<div class="my-3 mx-2">
    <div class="alert alert-danger" role="alert">
        <h2>
            Sei sicuro di voler cancellare l'account?
        </h2>
        <p>
            Una volta premuto conferma l'account non potra essere ripristinato.
        </p>
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Inserire Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="p" class="form-control fst-italic password" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
        <button type="button" id="eye" class=" eye input-embedded">
            <span id="icon" class="icon">
            </span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-danger col-12 fw-bold" value="Conferma" />
    </div>
</div>