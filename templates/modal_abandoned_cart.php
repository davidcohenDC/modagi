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