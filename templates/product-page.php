<?php
$prodotto = $templateParams["prodotto"];
?>

<!-- Link: Product Style Css -->
<script src="./js/product/product.js"></script>
<link href="<?php echo CSS_FILE . "/product/product.css" ?>" rel="stylesheet">

<!--Section: Product detail -->
<section id="productDetails">

  <!--Main card-->
  <div class="card">
    <!--Row: Prodotto-->
    <div class="row">
      <div class="col-12 col-lg-6">
        <div class="img-magnifier-container">
          <img src="<?php echo IMG_DIR."/".$prodotto["id"].".jpg" ?>" alt="<?php echo "Prodotto".$prodotto["nome"] ?>"
            class="img-fluid">
        </div>
      </div>
      <!-- Col: Azioni -->
      <div class="title col-12 col-lg-6">
      <?php if($prodotto["stock"] == 0) echo '<span class="product-badge badge-dark" aria-label="non disponibile">ESAURITO</span>'?>
      <?php if(checkValueInArray($templateParams["migliori"],"idProdotto",$prodotto['id'])) echo '<span class="product-badge badge-warning">CONSIGLIATO</span>'?>
        <span id="titolo"><?php echo $prodotto["nome"];?></span>
        <label><?php echo $prodotto["prezzo"];?>€</label>
        <!--Accordion wrapper-->
        <div class="accordion md-accordion" id="accordionEx">

          <!-- Accordion card Descrizione-->
          <div class="card ">
            <div class="card-header" id="wrapDescrizione">
              <a data-toggle="collapse" href="#collapseDescrizione" aria-expanded="true"
                aria-controls="collapseDescrizione" class="">
                <h5>Descrizione<span class="fa fa-angle-down" aria-hidden="true"></span></h5>
              </a>
            </div>
            <!-- Descrizione body-->
            <div id="collapseDescrizione" class="collapse show" aria-labelledby="wrapDescrizione"
              data-parent="#accordionEx">
              <div class="card-body">
                <?php if($prodotto["descrizione"] == "") {echo "nessuna descrizione...";} else {echo $prodotto["descrizione"];}?>
              </div>
            </div>
            <!-- Descrizione body-->
          </div>
          <!-- Accordion card Descrizione-->

          <!-- Accordion card Dettagli -->
          <div class="card card-no-shadow">
            <div class="card-header" id="wrapDettagli">
              <a class="collapsed" data-toggle="collapse" href="#collapseDettagli" aria-expanded="false"
                aria-controls="collapseDettagli">
                <h5>Dettagli<span class="fa fa-angle-down" aria-hidden="true"></span></h5>
              </a>
            </div>
            <!-- Dettagli body -->
            <div id="collapseDettagli" class="collapse " aria-labelledby="wrapDettagli">
              <div class="card-body">
                <table>
                  <tbody>
                    <tr>
                      <th class="pl-2 w-25" scope="row"><strong class="ml-5">Colore</strong></th>
                      <td><?php echo $templateParams["idColore"]['nome'];?></td>
                    </tr>
                    <tr>
                      <th class="pl-2 w-25" scope="row"><strong class="ml-5">Genere</strong></th>
                      <td><?php echo $templateParams["idGenere"]['nome'];?></td>
                    </tr>
                    <tr>
                      <th class="pl-2 w-25" scope="row"><strong class="ml-5">Materiale</strong></th>
                      <td><?php echo $templateParams["idMateriale"]['nome'];?></td>
                    </tr>
                    <tr>
                      <th class="pl-2 w-25" scope="row"><strong class="ml-5">Marca</strong></th>
                      <td><?php echo $templateParams["idMarca"]["nome"];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- Dettagli body -->
          </div>
          <!-- Accordion card Dettagli -->

          <!-- Accordion card Taglie -->
          <div class="card card-no-shadow">
            <div class="card-header" id="wrapTaglia">
              <a data-toggle="collapse" aria-expanded="true" href="#" aria-controls="collapseTaglia">
                <h5>Taglie Disponibili</h5>
              </a>
            </div>
            <!-- Taglia body -->
            <div id="collapseTaglia" class="collapse show" aria-labelledby="wrapTaglia">
              <div class="card-body">
                <?php foreach($templateParams["quantitaTaglia"] as $value => $taglia): ?>
                <input type="radio" id="<?php echo $taglia["numero"] ?>" value="<?php echo $taglia["quantita"] ?>"
                  name="taglia" <?php if($value ==0) {echo "checked";}?>>
                <label class="lblTaglia" for="<?php echo $taglia["numero"] ?>"><?php echo $taglia["numero"] ?></label>
                <?php endforeach ?>
              </div>
            </div>
            <!-- Taglia body -->
          </div>
          <!-- Accordion card Taglie -->

          <!-- Accordion Quantita -->
          <div class="card card-no-shadow">
            <div class="card-header" id="swapQuantita">
              <a data-toggle="collapse" aria-expanded="true" href="#" aria-controls="collapseQuantita">
                <h5>Quantità</h5>
              </a>
            </div>
            <!-- Quantita body -->
            <div id="collapseQuantita" class="collapse show" aria-labelledby="swapQuantita">
              <div class="card-body">
                <div class="def-number-input number-input safari_only mb-0">
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                    class="btn bnt-light fa fa-minus" <?php if($prodotto["stock"] == 0) { echo "disabled";} ?>></button>
                  <input title="range" type="number" class="number-wrapper" min="1" id="range"
                    max="<?php echo $templateParams["quantitaTaglia"][0]["quantita"]?>" name="number" value="<?php if($prodotto["stock"] == 0) { echo "0";} else {echo "1";} ?>"
                    disabled>
                  <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                    class="btn bnt-light fa fa-plus"  <?php if($prodotto["stock"] == 0) { echo "disabled";} ?>></button>
                </div>
              </div>
            </div>
            <!-- Quantita body -->
          </div>
          <!-- Accordion Quantita -->
        </div>
        <!-- Accordion wrapper -->

        <!-- Section: AddToCart -->
        <div class="cart">
          <div class=" mb-2">
            <div class="row">
              <div class="col-md-12">
                <form method="POST"
                  id="<?php if(isUserVendor()) { echo "formModifyProduct";} else {echo "formAddToCart";}?>">
                  <button type="submit" id="btnAdd"
                    class="btn-cart btn btn-<?php if(isUserVendor()) { echo "dark";} else {echo "info";}?> btn-rounder" <?php if(!isUserVendor() && $prodotto["stock"] == 0) { echo "disabled";} ?>><?php if(isUserVendor()) { 
                  echo '<span class="fa fa-eraser" aria-hidden="true"></span>Modifica';} else {echo '<span class="fa fa-cart-plus" aria-hidden="true"></span>Aggiungi al carrello';}?>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Section: AddToCart -->
      </div>
      <!-- Col: Azioni -->
    </div>
    <!--Row: Prodotto-->
  </div>
  <!--Main card-->
</section>