<div class="row">        
    <h1 class="fs-1 my-5 col-12 text-center fw-bold"> 
        Accedi!
    </h1>
</div>

<div class="row justify-content-lg-center">
<div class="col-1 col-md-2 col-lg-3">
    <!--empty space-->
</div>
<form method="POST" class="col-10 col-md-8 col-lg-6">
    
    <div class="my-3 mx-2 ">
        <label for="username" class="form-label fw-bold"> Username </label>
        <input id="username" name="username" class="form-control col-12 fst-italic" type="text" placeholder="inserire username" maxlength="20" required />
        <div class="invalid-feedback">
            Username non valido
        </div>
    </div>
    
    <div class="my-3 mx-2 ">
        <label for="password" class="form-label fw-bold"> Password </label>
        <input id="password" name="password" class="form-control col-12 fst-italic" type="password" placeholder="inserire password" minlength="6" maxlength="20" required />
        <div class="invalid-feedback">
                Password troppo corta: MINIMO 8 CARATTERI!
        </div>
    </div>

    <div class="my-4 mx-2">
        <input id="vendor" name="vendor" class="form-check-input" type="checkbox" value="true" />
        <label for="vendor" class="form-check-label fw-bold"> Sono un venditore </label>
    </div>
    
    <div class="row justify-content-md-center justify-content-lg-end">
        <div class="my-3 mx-2 col-md-10 col-lg-8"> 
            <input type="submit" class="btn btn-light col-12 fw-bold" value="Log In"/>
        </div>
    </div>
    
    <div class="my-4 text-end"> 
        <a href="registration-page.php">Non hai un Account? Registrati!</a>
    </div>
</form>
<div class="col-1 col-md-2 col-lg-3">
    <!--empty space-->
</div>
</div>