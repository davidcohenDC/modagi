<?php
$page = $paginator->getPage();
$totalPage = $paginator->getTotalPages();
?>

  <div class="row">

    <div class="col-lg-3">

      <h1 class="my-4">SH</h1>
      <div class="list-group">
      <?php foreach($templateParams["categorie"] as $categoria): ?>
        <a href="index.php?categoria=<?php echo $categoria["idCategoria"] ?>" class="list-group-item"><?php echo $categoria["nomeCategoria"] ?></a>
      <?php endforeach ?>
      </div>

    </div>
    <!-- /.col-lg-3 -->

    <div class="col-lg-9">

      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
        </ol>

        <div class="carousel-inner" role="listbox">
        <?php for($i = 0;$i <$templateParams["promozioni"]; $i++):?> 
        <div class="carousel-item <?php if($i==0) {echo " active";}?>">
            <img class="d-block img-fluid" src="<?php echo PROMOTION_DIR."promotion".$i.".jpg" ?>" alt="">
        </div>
      <?php endfor ?>    
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="row">

      <?php foreach($templateParams["prodotti"] as $prodotto): ?>
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="#"><img class="card-img-top" src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg" ?>" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="#"><?php echo $prodotto["nome"] ?></a>
              </h4>
              <h5>€<?php echo $prodotto["prezzo"] ?></h5>
              <p class="card-text"><?php echo $prodotto["descrizione"] ?></p>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>
      <?php endforeach ?>


      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-12">
          <ul class="pagination">
            <li><a href="?pag=1">First</a></li>
            <li class="<?php if($page <= 1){ echo 'disable';} ?>">
              <a href="<?php if($page <= 1){ echo "#";} else { echo "?pag=".($page-1);}?>">Prev</a>
            </li>
            <li class="<?php if($page >= $totalPage){ echo 'disabled'; } ?>">
              <a href="<?php if($page >= $totalPage){ echo '#'; } else { echo "?pag=".($page+1); } ?>">Next</a>
            </li>
            <li>
              <a href="?pag=<?php echo $totalPage; ?>">Last</a>
            </li>
          </ul>
        </div>
      </div>

    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->
