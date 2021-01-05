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
    <label for="email" class="form-label fw-bold"> E-mail </label>
    <input id="email" name="email" class="form-control col-12 fst-italic" type="email" placeholder="inserire username" required />
    <div class="invalid-feedback">
        email non valida
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="p" class="form-control fst-italic password" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
        <button type="button" id="eye" class="eye input-embedded">
            <span id="icon" class="e-icon"></span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="row justify-content-md-center justify-content-lg-end">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Registrati" />
    </div>
</div>