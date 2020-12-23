<div class="row">
        <!-- Riepilogo carrello -->
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
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
            <h4 class="mb-3">Billing address</h4>
          
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input id="firstName" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["nome"] ?>" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
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
                <label for="address">Address</label>
                <input id="address" type="text" class="form-control bg-secondary text-white" value="<?php echo $user["indirizzo"] ?>" readonly>
            </div>

            <hr class="mb-4">
            <!-- Selezione metodo di pagamento -->
            <form class="needs-validation" novalidate="" method="POST" action="complete_order.php">
                <h4 class="mb-3">Payment</h4>

                <div class="d-block my-3">
                    <div class="custom-control custom-radio">
                        <input id="credit" name="paymentMethod" type="radio" value="credit" class="custom-control-input" checked="" required="">
                        <label class="custom-control-label" for="credit">Credit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="debit" name="paymentMethod" type="radio" value="debit" class="custom-control-input" required="">
                        <label class="custom-control-label" for="debit">Debit card</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input id="paypal" name="paymentMethod" type="radio" value="paypal" class="custom-control-input" required="">
                        <label class="custom-control-label" for="paypal">Paypal</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="cc-name">Name on card</label>
                        <input type="text" name="cardName" class="form-control <?php if($incorrectData) {echo "bg-danger";} ?>" id="cc-name" placeholder="" required="">
                        <small class="text-muted">Full name as displayed on card</small>
                        <div class="invalid-feedback">Name on card is required</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="cc-number">Credit card number</label>
                        <input type="text" name="cardNumber" class="form-control <?php if($incorrectData) {echo "bg-danger";} ?>" id="cc-number" placeholder="" required="">
                        <div class="invalid-feedback">Credit card number is required</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label for="cc-expiration">Expiration</label>
                        <input type="text" name="cardExpiration" class="form-control <?php if($incorrectData) {echo "bg-danger";} ?>" id="cc-expiration" placeholder="" required="">
                        <div class="invalid-feedback">Expiration date required</div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="cc-cvv">CVV</label>
                        <input type="text" name="cardCVV" class="form-control <?php if($incorrectData) {echo "bg-danger";} ?>" id="cc-cvv" placeholder="" required="">
                        <div class="invalid-feedback">Security code required</div>
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
                <input class="btn btn-primary btn-lg btn-block" type="submit" value="Continue to checkout" />
           </form>
        </div>
      </div>