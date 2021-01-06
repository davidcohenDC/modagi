<script src="<?php echo CSS_FILE ?>mdb.min.js"></script>

<div class="modal fade" id="filter-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h5 modal-title">Visualizza Ordini</div>
                <button type="button" class="btn-light btn" data-mdb-dismiss="modal" aria-label="Close">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                    </svg>
                </button>
            </div>
            <div class="modal-body text-center">
                <?php if (isUserVendor()) : ?>
                    <div class="my-3 mx-2 col-12">
                        <a href="vendor-action-page.php?action=11&status=0" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 0) {
                                                                                                        echo "info text-white";
                                                                                                    } else {
                                                                                                        echo "light";
                                                                                                    } ?> col-12 fw-bold"> Tutti </a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="vendor-action-page.php?action=11&status=2" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 2) {
                                                                                                        echo "info text-white";
                                                                                                    } else {
                                                                                                        echo "light";
                                                                                                    } ?> col-12 fw-bold"> Solo spediti </a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="vendor-action-page.php?action=11&status=1" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 1) {
                                                                                                        echo "info text-white";
                                                                                                    } else {
                                                                                                        echo "light";
                                                                                                    } ?> col-12 fw-bold"> Solo confermati </a>
                    </div>
                <?php else : ?>
                    <div class="my-3 mx-2 col-12">
                        <a href="user-action-page.php?action=1&status=0" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 0) {
                                                                                                    echo "info text-white";
                                                                                                } else {
                                                                                                    echo "light";
                                                                                                } ?> col-12 fw-bold"> Tutti </a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="user-action-page.php?action=1&status=4" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 4) {
                                                                                                    echo "info text-white";
                                                                                                } else {
                                                                                                    echo "light";
                                                                                                } ?> col-12 fw-bold"> Solo non consegnati</a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="user-action-page.php?action=1&status=3" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 3) {
                                                                                                    echo "info text-white";
                                                                                                } else {
                                                                                                    echo "light";
                                                                                                } ?> col-12 fw-bold"> Solo consegnati </a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="user-action-page.php?action=1&status=2" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 2) {
                                                                                                    echo "info text-white";
                                                                                                } else {
                                                                                                    echo "light";
                                                                                                } ?> col-12 fw-bold"> Solo spediti </a>
                    </div>
                    <div class="my-3 mx-2 col-12">
                        <a href="user-action-page.php?action=1&status=1" class="px-3 py-2 btn-<?php if (isset($templateParams["filter"]) && $templateParams["filter"] == 1) {
                                                                                                    echo "info text-white";
                                                                                                } else {
                                                                                                    echo "light";
                                                                                                } ?> col-12 fw-bold"> Solo confermati </a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>