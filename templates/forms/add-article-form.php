<!-- for better file upload -->
<script src="<?php echo JS_FILE ?>file-upload.js"></script>

<div class="my-3 mx-2 ">
    <label for="input-file-now" class="form-label fw-bold"> Immagine Aricolo </label>
    <div class="file-upload-wrapper">
        <input type="file" id="input-file-now" class="file-upload" />
    </div>
</div>

<div class="my-3 mx-2 ">
    <label for="name" class="form-label fw-bold"> Nome Aricolo </label>
    <input id="name" name="name" class="form-control col-12 fst-italic" type="text" placeholder="inserire nome articolo" maxlength="20" required />
</div>

<div class="my-3 mx-2 ">
    <label for="description" class="form-label fw-bold"> Descrizzione </label>
    <textarea id="description" name="description" class="md-textarea form-control col-12 fst-italic" type="text" placeholder="descrizione del prodotto" rows="3" required></textarea>
</div>

<div class="my-3 mx-2 ">
    <label for="material" class="form-label fw-bold"> Materiale </label>
    <input id="material" name="material" class="form-control col-12 fst-italic" type="text" placeholder="material" required />
</div>

<div class="my-3 mx-2 ">
    <label for="brand" class="form-label fw-bold"> Marca </label>
    <input id="brand" name="brand" class="form-control col-12 fst-italic" type="text" placeholder="brand" required />
</div>

<div class="my-3 mx-2">
    <div class="form-row mb-4">
        <div class="col">
            <div class="my-3 mx-2 ">
                <label for="size" class="form-label fw-bold"> Tagie </label>
                <div id="size" aria-label="Lista di taglie da cui scegliere">
                    <?php foreach ($formParams["sizes"] as $size) : ?>
                        <div class="form-check">
                            <input id="size<?php echo $size['id'] ?>" class="form-check-input" name="size" type="checkbox" value="<?php echo $size['id'] ?>" />
                            <label class="form-check-label" for="size<?php echo $size['id'] ?>">
                                <?php echo $size['numero'] ?>
                            </label>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="my-3 mx-2 ">
                <label for="color" class="form-label fw-bold"> Colore </label>
                <select id="color" name="color" class="form-select" aria-label="Lista di colori da cui scegliere" required>
                    <?php foreach ($formParams["colors"] as $color) : ?>
                        <option value="<?php echo $color['id'] ?>"><?php echo $color['nome'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>
</div>


<div class="my-3 mx-2">
    <div class="form-row mb-4">
        <div class="col my-3">
            <label for="gender" class="form-label fw-bold"> Genere </label>
            <div id="gender">

                <!-- Group of default radios - option 1 -->
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="male" name="gender" value="1" />
                    <label class="custom-control-label" for="male">Uomo</label>
                </div>

                <!-- Group of default radios - option 2 -->
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="female" name="gender" value="2" />
                    <label class="custom-control-label" for="female">Donna</label>
                </div>

                <!-- Group of default radios - option 3 -->
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="unisex" name="gender" value="3" checked />
                    <label class="custom-control-label" for="unisex">Unisex</label>
                </div>
            </div>
        </div>

        <div class="col">
            <div>
                <label for="stock" class="form-label fw-bold"> Quantità in Stock </label>
                <input id="stock" name="stock" class="form-control col-12 fst-italic" type="number" placeholder="quantità di scarpe in stock" required />
            </div>
            <div class="my-3">
                <label for="price-group" class="form-label fw-bold"> Prezzo </label>
                <div id="price-group" class="input-group">
                    <span class="input-group-text">€</span>
                    <input id="price" name="price" class="form-control col-12 fst-italic" type="number" placeholder="prezzo per unità" required />
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row justify-content-md-center">
    <div class="my-3 mx-2 col-md-10 col-lg-8">
        <input type="submit" class="btn btn-light col-12 fw-bold" value="Aggiungi" />
    </div>
</div>