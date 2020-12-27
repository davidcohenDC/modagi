<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script>

function showLoading(submitBtn) {
    $(submitBtn).prop("disabled", true);
    $(submitBtn).html(
        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style="margin-bottom: 4px; margin-right: 5px;"></span>Continue to checkout'
    );
    $("#form").submit();
}

</script>

<div class="row">
    <!-- Riepilogo carrello -->
    <div class="col-md-4 order-md-2 mb-4">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
            <a href="cart.php" class="text-muted">Riepilogo carrello</a>
            <span class="badge badge-secondary badge-pill"><?php echo $cart["orderCount"] ?></span>
        </h4>
        <ul class="list-group mb-3">
            <?php foreach ($cart["articleDetails"] as $article): ?>
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                    <h6 class="my-0"><?php echo $article["nome"] ?></h6>
                    <small class="text-muted">Quantita: <?php echo $article["quantita"] ?></small>
                </div>
                <span class="text-muted"><?php echo $article["prezzo"] ?></span>
            </li>
            <?php endforeach ?>
            
            <li class="list-group-item d-flex justify-content-between">
                <span>Total (EURO)</span>
                <strong><?php echo $cart["totalPrice"] ?>€</strong>
            </li>
        </ul>
    </div>
    
    <!-- Pagina di checkout -->
    <div class="col-md-8 order-md-1">
        <!-- Riepilogo dati utente -->
        <?php if(!isUserLoggedIn()) :?>
            <!-- ADVISE THAT THERE ARE NO PRODUCT IN CART -->
        <div class="alert alert-warning">
            Non hai effettuato il login <a href="user-page.php" class="alert-link">Clicca qui loggarti e acquistare!</a>
        </div>
        <?php else: ?>
        <h4 class="mb-3">Indirizzo di consegna</h4>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="firstName">Nome</label>
                <input id="firstName" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["nome"] ?>" readonly>
            </div>
            <div class="col-md-6 mb-3">
                <label for="lastName">Cognome</label>
                <input if="lastName" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["cognome"] ?>" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="username">Username</label>
            <div class="input-group">
                <input id="username" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["username"] ?>" readonly>
            </div>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input id="email" type="email" class="form-control bg-secondary text-white" value="<?php echo $user["email"] ?>" readonly>
        </div>

        <div class="mb-3">
            <label for="address">Indirizzo</label>
            <input id="address" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["indirizzo"] ?>" readonly>
        </div>

        <hr class="mb-4">
        <!-- Selezione metodo di pagamento -->
        <form id="form" class="needs-validation" novalidate="" method="POST" action="complete_order.php">
            <h4 class="mb-3">Pagamento</h4>

            <div class="d-block my-3">
                <div class="custom-control custom-radio">
                    <input id="credit" name="paymentMethod" type="radio" value="credit" class="custom-control-input" checked="" required="">
                    <label class="custom-control-label" for="credit">Carta di credito</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="debit" name="paymentMethod" type="radio" value="debit" class="custom-control-input" required="">
                    <label class="custom-control-label" for="debit">Carta di debito</label>
                </div>
                <div class="custom-control custom-radio">
                    <input id="paypal" name="paymentMethod" type="radio" value="paypal" class="custom-control-input" required="">
                    <label class="custom-control-label" for="paypal">Paypal</label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="cc-name">Nome sulla carta</label>
                    <input type="text" name="cardName" class="form-control <?php if($incorrectData) {echo "bg-danger text-white";} ?>" id="cc-name" placeholder="" required="">
                    <small class="text-muted">Nome completo mostrato sulla carta</small>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cc-number">Numero carta di credito</label>
                    <input type="text" name="cardNumber" class="form-control <?php if($incorrectData) {echo "bg-danger text-white";} ?>" id="cc-number" placeholder="" required="">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="cc-expiration">Scadenza</label>
                    <input type="text" name="cardExpiration" class="form-control <?php if($incorrectData) {echo "bg-danger text-white";} ?>" id="cc-expiration" placeholder="" required="">
                </div>
                <div class="col-md-3 mb-3">
                    <label for="cc-cvv">CVV</label>
                    <input type="text" name="cardCVV" class="form-control <?php if($incorrectData) {echo "bg-danger text-white";} ?>" id="cc-cvv" placeholder="" required="">
                </div>
            </div>
            <?php if($incorrectData) : ?>
            <div id="incorrectMessage" class="col-md-12 mb-3">
                <div class="text-danger text-center">
                    <?php echo $incorrectData ?>
                </div>
            </div>
            <?php endif ?>
            <hr class="mb-4">
            <div class="row">
                <button class="btn btn-primary btn-lg btn-block" type="submit" onclick="showLoading(this)" >Continue to checkout</button>
            </div>
        </form>
        <?php endif ?>
    </div>
</div>
