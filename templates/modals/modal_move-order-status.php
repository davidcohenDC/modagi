<div class="modal fade" id="add-modal" tabindex="-1" aria-labelledby="modal to add new values fields" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> Conferma </h5>
                <button type="button" class="btn-light btn" data-mdb-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">

                <div class="my-3 mx-2">
                    <label for="new-value" class="form-label fw-bold"> <span class="modal-name"> </span> da aggiungere </label>
                    <input id="new-value" name="new-value" class="form-control col-12 fst-italic" type="text" placeholder="inserire valore da aggiungere" maxlength="40" />
                </div>

                <div class="my-3 mx-2">
                    <a href="#" class="px-3 py-2 btn-info col-12 fw-bold modal-confirm" onclick=""> Conferma </a>
                </div>

            </div>
        </div>
    </div>
</div>