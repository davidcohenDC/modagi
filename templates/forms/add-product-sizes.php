<!-- for change buttons -->
<script src="<?php echo JS_FILE ?>user/change-data-selector.js"></script>

<div class="my-3 mx-2">
    <fieldset id="size">
        <legend class="form-label fw-bold"> Modifica Quantità Disponibili </legend>
        <?php foreach ($formParams["sizes"] as $size) : ?>
            <div class="input-group mb-3">
                <?php

                $sizeExists = false;
                foreach ($formParams['quantities'] as $index) {
                    if ($index["idTaglia"] == $size['id']) {
                        $sizeExists = true;
                        $quantityId = key($formParams['quantities']);
                    }
                }

                if ($sizeExists) {
                    $value = $formParams['quantities'][$quantityId]["quantita"];
                } else {
                    $value = 0;
                }
                ?>

                <button id="select-<?php echo $size['numero'] ?>" class="select input-embedded size <?php if ($value == 0) {
                                                                                                        echo 'no-select';
                                                                                                    } ?>">
                    <span><?php echo $size['numero'] ?></span>
                </button>

                <input id="quantity-<?php echo $size['id'] ?>" name="quantity-<?php echo $size['id'] ?>" class="form-control col-12 fst-italic" type="number" min="0" value="<?php echo $value ?>" placeholder="quantità per taglia" />
            </div>

        <?php endforeach ?>

        <div class="my-3">
            <button class="px-3 py-2 btn-outline-success input-embedded add-button for-taglia action-4 prev-9" data-mdb-toggle="modal" data-mdb-target="#add-modal">
                <span> Aggiungi
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                    </svg>
                </span>
            </button>
        </div>
    </fieldset>
</div>

<div class="row justify-content-md-center">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Conferma Modifiche" />
    </div>
</div>

<!--modal-->
<?php require('templates/modals/modal_add-param.php'); ?>