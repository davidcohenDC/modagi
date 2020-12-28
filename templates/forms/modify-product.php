<script src="<?php echo JS_FILE ?>add-params.js"></script>

<a href="vendor-action-page.php?action=9" class="my-3 btn btn-light fw-bold"> Modifica Quantità per Taglia </a>

<!--modal-->
<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aggiungi <span class="modal-name"> </span> </h5>
                <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="my-3 mx-2">
                    <label for="new-value" class="form-label fw-bold"> <span class="modal-name"> </span> da aggiungere </label>
                    <input id="new-value" name="new-value" class="form-control col-12 fst-italic" type="text" placeholder="inserire valore da aggiungere" maxlength="40" />
                </div>

                <div class="my-3 mx-2">
                    <a href="#" class="px-3 py-2 btn-primary col-12 fw-bold modal-confirm" onclick=""> Conferma </a>
                </div>

            </div>
        </div>
    </div>
</div>