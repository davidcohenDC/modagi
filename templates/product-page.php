<?php
$prodotto = $templateParams["prodotto"];

?>

<div class="container mt-5 pt-3">

    <!--Section: Product detail -->
    <section id="productDetails" class="pb-5">

      <!--News card-->
      <div class="card mt-6 hoverable">
        <div class="row mt-5">

          <div class="col-lg-6">

            <div class="text-center text-md-left">
                <img src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg" ?>" alt="First slide" class="img-fluid">
            </div>

          </div>

          <div class="col-lg-5 mr-3 text-center text-md-left">
            <h2 class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">
              <strong><?php echo $prodotto["nome"];?></strong>
            </h2>
            <span class="badge badge-danger product mb-4 ml-xl-0 ml-4">nuovo!</span>
            <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
              <span class="red-text font-weight-bold ">
                <strong><?php echo $prodotto["prezzo"];?>€</strong>
              </span>
            </h3>

            <!--Accordion wrapper-->
            <div class="accordion md-accordion pt-3 pb-3" id="accordionEx" aria-multiselectable="true">

              <!-- Accordion card -->
              <div class="card">

                <!-- Card header -->
                <div class="card-header" id="headingOne1">
                  <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true" aria-controls="collapseOne1" class="">
                    <h5 class="mb-0">
                      Descrizione
                      <i class="fas fa-angle-down rotate-icon"></i>
                    </h5>
                  </a>
                </div>

                <!-- Card body -->
                <div id="collapseOne1" class="collapse show" aria-labelledby="headingOne1" data-parent="#accordionEx" >
                  <div class="card-body"><?php if($prodotto["descrizione"] == "") {echo "nessuna descrizione...";} else {echo $prodotto["descrizione"];}?></div>
                </div>
              </div>
              <!-- Accordion card -->

              <!-- Accordion card -->
              <div class="card">

                <!-- Card header -->
                <div class="card-header" id="headingThree3">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3" aria-expanded="false" aria-controls="collapseThree3">
                    <h5 class="mb-0">
                      Dettagli
                      <i class="fas fa-angle-down rotate-icon"></i>
                    </h5>
                  </a>
                </div>

                <!-- Card body -->
                <div id="collapseThree3" class="collapse show"  aria-labelledby="headingThree3" data-parent="#accordionEx" >
                  <div class="card-body">
                    <ul>
                      <li>Colore: <?php echo $templateParams["idColore"]['nome'];?></li>
                      <li>Genere: <?php echo $templateParams["idGenere"]['nome'];?></li>
                      <li>Materiale: <?php echo $templateParams["idMateriale"]['nome'];?></li>
                      <li>Marca: <?php echo $templateParams["idMarca"]["nome"];?></li>
                    </ul>
                  </div>
                </div>
              </div>
              <!-- Accordion card -->
            </div>
            <!--/.Accordion wrapper-->

            <!-- Add to Cart -->
            <section class="cart">

              <div class="mt-5 text-center">
                <div class="row mt-3 mb-4">
                  <div class="col-md-12 text-center text-md-center text-md-right">
                    <button class="btn btn-primary btn-rounder">
                      <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Aggiungi al carrello</button>
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