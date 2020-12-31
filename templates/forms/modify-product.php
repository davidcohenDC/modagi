<script src="<?php echo JS_FILE ?>user/file-upload.js"></script>

<div class="my-3 mx-2 ">
    <label for="shoe-img" class="upload-img-label col-12 py-2 text-center fw-bold btn-outline-secondary">
        <span class="upload-img">
            Modifica
        </span>
    </label>
    <input type="file" id="shoe-img" name="shoe-img" class="file-upload" accept="image/png, image/jpeg, image/jpg, image/gif" />
</div>

<div class=" my-3 mx-2 ">
    <label for=" name" class="form-label fw-bold"> Modifica Nome Aricolo </label>
    <input id="name" name="name" class="form-control col-12 fst-italic" type="text" placeholder="inserire nome articolo" maxlength="20" value="<?php echo $formParams['current']['nome']; ?>" required />
</div>

<div class="my-3 mx-2 ">
    <label for="description" class="form-label fw-bold"> Modifica Descrizzione </label>
    <textarea id="description" name="description" class="md-textarea form-control col-12 fst-italic" type="text" placeholder="descrizione del prodotto" rows="3" required><?php echo $formParams['current']['descrizione']; ?></textarea>
</div>

<div class="my-3 mx-2 ">
    <label for="material" class="form-label fw-bold"> Modifica Materiale </label>
    <select id="material" name="material" class="form-select col-12" aria-label="Lista di materiali da cui scegliere" required>
        <?php foreach ($formParams["materials"] as $material) : ?>
            <option value="<?php echo $material['id'] ?>" <?php if ($formParams['current']['idMateriale'] == $material['id']) {
                                                                echo 'selected';
                                                            } ?>><?php echo $material['nome'] ?></option>
        <?php endforeach ?>
    </select>
    <div class="my-2">
        <button class="px-3 py-2 btn-outline-success input-embedded add-button for-materiale action-2 prev-<?php echo $formParams["previousAction"]; ?>" data-mdb-toggle="modal" data-mdb-target="#add-modal">
            <span> Aggiungi
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </button>
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="brand" class="form-label fw-bold"> Modifica Marca </label>
    <select id="brand" name="brand" class="form-select col-12" aria-label="Lista di marche da cui scegliere" required>
        <?php foreach ($formParams["brands"] as $brand) : ?>
            <option value="<?php echo $brand['id'] ?>" <?php if ($formParams['current']['idMarca'] == $brand['id']) {
                                                            echo 'selected';
                                                        } ?>><?php echo $brand['nome'] ?></option>
        <?php endforeach ?>
    </select>
    <div class="my-3">
        <button class="px-3 py-2 btn-outline-success input-embedded add-button for-marca action-3 prev-<?php echo $formParams["previousAction"]; ?>" data-mdb-toggle="modal" data-mdb-target="#add-modal">
            <span> Aggiungi
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </button>
    </div>
</div>

<div class="my-3 mx-2">


    <label for="gender" class="form-label fw-bold"> Modifica Genere </label>
    <div id="gender">

        <!-- Group of default radios - option 1 -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="male" name="gender" value="1" <?php if ($formParams['current']['idGenere'] == 1) {
                                                                                                    echo 'checked';
                                                                                                } ?> />
            <label class="custom-control-label" for="male">Uomo</label>
        </div>

        <!-- Group of default radios - option 2 -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="female" name="gender" value="2" <?php if ($formParams['current']['idGenere'] == 2) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
            <label class="custom-control-label" for="female">Donna</label>
        </div>

        <!-- Group of default radios - option 3 -->
        <div class="custom-control custom-radio">
            <input type="radio" class="custom-control-input" id="unisex" name="gender" value="3" <?php if ($formParams['current']['idGenere'] == 3) {
                                                                                                        echo 'checked';
                                                                                                    } ?> />
            <label class="custom-control-label" for="unisex">Unisex</label>
        </div>
    </div>
</div>


<div class="my-3 mx-2">
    <label for="price-group" class="form-label fw-bold"> Modifica Prezzo </label>
    <div id="price-group" class="input-group">
        <span class="input-group-text">€</span>
        <input id="price" name="price" class="form-control col-12 fst-italic" type="number" step="0.01" min="0" placeholder="prezzo per unità" value="<?php echo $formParams['current']['prezzo']; ?>" required />
    </div>
</div>

<div class="my-3 mx-2">
    <label for="color" class="form-label fw-bold"> Modifica Colore </label>
    <select id="color" name="color" class="form-select col-12" aria-label="Lista di colori da cui scegliere" required>
        <?php foreach ($formParams["colors"] as $color) : ?>
            <option value="<?php echo $color['id'] ?>" <?php if ($formParams['current']['idColore'] == $color['id']) {
                                                            echo 'selected';
                                                        } ?>><?php echo $color['nome'] ?></option>
        <?php endforeach ?>
    </select>

    <div class="my-3">
        <button class="px-3 py-2 btn-outline-success input-embedded add-button for-colore action-5 prev-<?php echo $formParams["previousAction"]; ?>" data-mdb-toggle="modal" data-mdb-target="#add-modal">
            <span> Aggiungi
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </button>
    </div>

</div>

<div class="my-3 mx-2">
    <div>
        <label for="categories-group" class="form-label fw-bold"> Modifica Categorie </label>
    </div>
    <div id="categories-group col-12" aria-label="Lista di categorie da cui scegliere">
        <?php foreach ($formParams["categories"] as $category) : ?>

            <?php
            $hasCategory = false;
            foreach ($formParams['currentCategories'] as $index) {
                if ($index["idCategoria"] == $category['id']) {
                    $hasCategory = true;
                }
            }
            ?>

            <div class="form-check">
                <input id="category-<?php echo $category['id'] ?>" class="form-check-input" name="category-<?php echo $category['id'] ?>" type="checkbox" value="<?php echo $category['id'] ?>" <?php if ($hasCategory) {
                                                                                                                                                                                                    echo 'checked';
                                                                                                                                                                                                } ?> />
                <label class="form-check-label" for="category-<?php echo $category['id'] ?>">
                    <?php echo $category['nome'] ?>
                </label>
            </div>

        <?php endforeach ?>
    </div>

    <div class="my-3">
        <button class="px-3 py-2 btn-outline-success input-embedded add-button for-categoria action-6 prev-<?php echo $formParams["previousAction"] ?>" data-mdb-toggle="modal" data-mdb-target="#add-modal">
            <span> Aggiungi
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </button>
    </div>
</div>

<div class="row justify-content-md-center">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Conferma Modifiche" />
    </div>

    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <a href="vendor-action-page.php?action=9&product=<?php echo $productID; ?>" class="my-3 btn btn-info fw-bold col-12"> Modifica Quantità per Taglia </a>

    </div>
</div>


<!--modal-->
<?php require('templates/modals/modal_add-param.php'); ?>