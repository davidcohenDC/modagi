<div class="my-3 mx-2">
    <div class="alert alert-danger text-center" role="alert">
        <h2>
            <?php echo $confirmParams["title"]; ?>
        </h2>
        <p>
            <?php echo $confirmParams["msg"]; ?>
        </p>
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="password-group" class="form-label fw-bold"> Inserire Password </label>
    <div id="password-group" class="input-group mb-3">
        <input id="password" name="p" class="form-control fst-italic password" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
        <button type="button" id="eye" class=" eye input-embedded">
            <span id="icon" class="e-icon">
            </span>
        </button>
    </div>
    <div class="invalid-feedback">
        Password troppo corta
    </div>
</div>

<div class="row justify-content-md-center">

    <div class="my-2 mx-2 col-md-10 col-lg-8">
        <a href="<?php echo $confirmParams["cancel"]; ?>" class="my-3 btn btn-light fw-bold col-12"> Annulla </a>
    </div>

    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-danger col-12 fw-bold" value="Conferma" />
    </div>
</div>