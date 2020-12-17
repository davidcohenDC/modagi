<!-- for eye to show password -->
<script src="<?php echo JS_FILE ?>password-viewer.js"></script>

<div class="row">
    <h1 class="fs-1 my-5 col-12 text-center fw-bold">
        Cambia Password
    </h1>
</div>

<div class="row justify-content-lg-center">
    <div class="col-1 col-md-2 col-lg-3">
        <!--empty space-->
    </div>
    <form method="POST" class="col-10 col-md-8 col-lg-6">

        <div class="my-3 mx-2 ">
            <label for="old-password-group" class="form-label fw-bold"> Vecchia Password </label>
            <div id="old-password-group" class="input-group mb-3">
                <input id="old-password" name="old-password" class="form-control fst-italic password" type="password" placeholder="inserire la password da cambiare" minlength="6" maxlength="20" required />
                <button id="old-eye" class="show-password eye">
                    <span id="old-icon" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z" />
                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
                    </span>
                </button>
            </div>
            <div class="invalid-feedback">
                Password troppo corta
            </div>
        </div>

        <div class="my-3 mx-2 ">
            <label for="new-password-group" class="form-label fw-bold"> Nuova Password </label>
            <div id="new-password-group" class="input-group mb-3">
                <input id="new-password" name="new-password" class="form-control fst-italic password" type="password" placeholder="inserire la nuova password" minlength="6" maxlength="20" required />
                <button id="new-eye" class="show-password eye">
                    <span id="new-icon" class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.134 13.134 0 0 0 1.66 2.043C4.12 11.332 5.88 12.5 8 12.5c2.12 0 3.879-1.168 5.168-2.457A13.134 13.134 0 0 0 14.828 8a13.133 13.133 0 0 0-1.66-2.043C11.879 4.668 10.119 3.5 8 3.5c-2.12 0-3.879 1.168-5.168 2.457A13.133 13.133 0 0 0 1.172 8z" />
                            <path fill-rule="evenodd" d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                        </svg>
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