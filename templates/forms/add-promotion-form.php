<script src="<?php echo JS_FILE ?>user/file-upload.js"></script>

<div class="my-3 mx-2 ">
    <label for="promo-img" class="upload-img-label col-12 fw-bold btn btn-outline-dark ">
        <span class="upload-img">
            Inserisci
        </span>
    </label>
    <input type="file" id="promo-img" name="promo-img" class="file-upload" accept="image/png, image/jpeg, image/jpg, image/gif" />
</div>

<div class=" my-3 mx-2 ">
    <label for="shoe" class="form-label fw-bold"> Scarpa in evidenza </label>
    <select id="shoe" name="shoe" class="form-control col-12" aria-label="Lista di materiali da cui scegliere" required>
        <option value="">...</option>
        <?php foreach ($formParams["shoes"] as $shoe) : ?>
            <option value="<?php echo $shoe['nome'] ?>"><?php echo $shoe['nome'] ?></option>
        <?php endforeach ?>
    </select>
    <div class="my-3 ">
        <a href="vendor-action-page.php?action=1" class="btn btn-outline-success add-button for-materiale action-2">
            <span> Aggiungi
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </a>
    </div>
</div>

<div class="row justify-content-md-center justify-content-lg-end">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Aggiungi Pormozione" />
    </div>
</div>