<div class="modal fade right" id="modalProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-side modal-bottom-right modal-dancer modal-dancer" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header ">
        <strong><h3 class="heading">Quantita minima necessaria!</h3></strong>
      </div>

      <!--Body-->
      <div class="modal-body">

        <div class="row">
          <div class="col-3">
            <p></p>
            <p class="text-center"><i class="fa fa-question fa-4x" aria-hidden="true"></i></p>
          </div>

          <div class="col-9">
            <p>Per aggiungere al carrello il prodotto devi avere una quantità minima</p>
          </div>
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
      <a href="product.php?prodotto=<?php echo $_GET["prodotto"]?>" id="btnReturnHome" class="btn btn-info btn-rounder" >OK</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Modal -->