<div class="my-3 mx-2 ">
    <label for="username" class="form-label fw-bold"> Username </label>
    <input id="username" name="username" class="form-control col-12 fst-italic" type="text" placeholder="inserire username" maxlength="20" required />
    <div class="invalid-feedback">
        Username non valido
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="password" class="form-control fst-italic password" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
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