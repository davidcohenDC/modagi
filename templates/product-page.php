<?php
$prodotto = $templateParams["prodotto"];

?>

<div class="container mt-5 pt-3">

  <!--Section: Product detail -->
  <section id="productDetails" class="pb-5">

    <!--News card-->
    <div class="card">
      <div class="row">

        <div class="col-12 col-lg-6">
        <img src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg" ?>" alt="First slide" class="img-fluid">

        </div>

        <div class="col-12 col-lg-5 mr-3 text-center ">
          <h2
            class="mt-3 h2-responsive text-center product-name font-weight-bold dark-grey-text mb-1">
            <strong ><?php echo $prodotto["nome"];?></strong> 
          </h2>
          
          <h4 class="text-center mb-2">
            <span class="red-text font-weight-bold ">
              <strong><?php echo $prodotto["prezzo"];?>€</strong>
            </span>
          </h4>

          <!--Accordion wrapper-->
          <div class="accordion md-accordion pt-3 pb-3" id="accordionEx" aria-multiselectable="true">

            <!-- Accordion card -->
            <div class="card ">

              <!-- Card header -->
              <div class="card-header" id="headingOne1">
                <a data-toggle="collapse"  href="#collapseOne1" aria-expanded="true"
                  aria-controls="collapseOne1" class="">
                  <h5 class="mb-0">
                    Descrizione
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </h5>
                </a>
              </div>

              <!-- Card body -->
              <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordionEx">
                <div class="card-body">
                  <?php if($prodotto["descrizione"] == "") {echo "nessuna descrizione...";} else {echo $prodotto["descrizione"];}?>
                </div>
              </div>
            </div>
            <!-- Accordion card -->

            <!-- Accordion card -->
            <div class="card card-no-shadow">

              <!-- Card header -->
              <div class="card-header" id="headingThree3">
                <a class="collapsed" data-toggle="collapse"  href="#collapseThree3"
                  aria-expanded="false" aria-controls="collapseThree3">
                  <h5 class="mb-0">
                    Dettagli
                    <i class="fa fa-angle-down" aria-hidden="true"></i>
                  </h5>
                </a>
              </div>

              <!-- Card body -->
              <div id="collapseThree3" class="collapse " aria-labelledby="headingThree3" >
                <div class="card-body">
                  <table class="table table-borderless">
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


            <!-- Accordion card -->
            <div class="card card-no-shadow">

              <!-- Card header -->
              <div class="card-header" id="headingOne4">
                <a data-toggle="collapse" aria-expanded="true"
                  aria-controls="collapseOne1" class="">
                  <h5 class="mb-0">
                    Taglie Disponibili
                  </h5>
                </a>
              </div>

              <!-- Card body -->
              <div id="collapseOne4" class="collapse show" aria-labelledby="headingOne4">
                <div class="card-body">
                <div class="col-md-12">
                <?php foreach($templateParams["quantitaTaglia"] as $value => $taglia): ?>
                <input type="radio" name="taglia" id="<?php echo $taglia["quantita"] ?>" value="<?php echo $taglia["numero"] ?>" class="mr-1" <?php if($value ==0) {echo "checked";}?>><label class="mr-3" for="radio" ><?php echo $taglia["numero"] ?> </label>
                <?php endforeach ?>
                </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->
  
            <!-- Accordion card -->
            <div class="card card-no-shadow">

              <!-- Card header -->
              <div class="card-header" id="headingOne4">
                <a data-toggle="collapse" aria-expanded="true"
                  aria-controls="collapseOne1" class="">
                  <h5 class="mb-0">
                    Quantità
                  </h5>
                </a>
              </div>

              <!-- Card body -->
              <div id="collapseOne4" class="collapse show" aria-labelledby="headingOne4">
                <div class="card-body">
                <div class="col-md-12">
                <div class="def-number-input number-input safari_only mb-0">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="btn bnt-light fa fa-minus"></button>
                        <input class="number-wrapper" min="0" max="<?php echo $templateParams["quantitaTaglia"][0]["quantita"]?>"name="number" value="1" type="number">
                        <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="btn bnt-light fa fa-plus"></button>
                      </div>
          </div>
                </div>
                </div>
              </div>
            </div>
            <!-- Accordion card -->

            </div>
            <!-- Accordion card -->

          <!--/.Accordion wrapper-->
          <!-- Add to Cart -->
          <section class="cart">
            <div class=" mb-2 text-center">
              <div class="row">
                <div class="col-md-12 text-center text-md-center text-md-right">
                <form method="POST" id="formAddToCart" action="">
                <button type="submit" zid="btnAdd" class="btn btn-info btn-rounder"><i class="fa fa-cart-plus" aria-hidden="true"></i> Aggiungi al carrello</button>
                </form>
                </div>
              </div>
            </div>
          </section>
          <!-- /.Add to Cart -->

        </div>
      </div>
    </div>
  </section>

</div>

<div class="modal fade right" id="modalAbandonedCart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="false">
  <div class="modal-dialog modal-side modal-bottom-right modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header  text-center">
        <strong><h3 class="heading"><?php echo  $templateParams["idMarca"]["nome"]." ".$prodotto["nome"] ?></strong> nel carrello!</h3>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row">
          <div class="col-3">
            <p></p>
            <p class="text-center"><i class="fa fa-shopping-cart fa-4x" aria-hidden="true"></i></p>
          </div>

          <div class="col-9">
            <p>Hai bisogno di più tempo per decidere?</p>
            <p>Nessun problema, il tuo prodotto ti aspetterà nel carrello.</p>
          </div>
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
      <a href="index.php" id="btnReturnHome" class="btn btn-info btn-rounder" >Continua a Comprare</a>
      <a href="cart.php" id="btnReturnHome" class="btn btn-info btn-rounder" >Vai al Carrello</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Modal -->