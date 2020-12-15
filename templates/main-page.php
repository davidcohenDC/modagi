<?php
$page = $paginator->getPage();
$totalPage = $paginator->getTotalPages();
$url = "";
?>

<div class="row">

  <div class="col-lg-3">

    <section class="mb-4">
      <h6 class="font-weight-bold mb-3">Marca</h6>
      <?php foreach($templateParams["marca"] as $marca): ?>
      <div class="form-check pl-0 mb-3">
        <input type="checkbox" class="form-check-input filled-in" id="new">
        <label class="form-check-label small text-uppercase card-link-secondary" for="new"><?php echo $marca["nome"] ?></label>
      </div>
      <?php endforeach ?>
    </section>

    <section class="mb-4">
      <h6 class="font-weight-bold mb-3">Colore</h6>
      <div class="btn-group btn-group-toggle btn-color-group d-block pl-0 mb-3" data-toggle="buttons">
        <?php foreach($templateParams["colori"] as $colore): ?>
        <label class="btn rounded-circle btn-<?php echo strtolower($colore["nome"]); ?> p-3 m-2" >
          <input id="colore-<?php echo $colore["nome"]; ?>" class="filter-option" type="checkbox"/>
        </label>
        <?php endforeach ?>
      </div>
    </section>
  </div>

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

    <nav>
      <ul class="pagination pg-red">
        <li class="page-item">
          <a class="page-link" aria-label="Previous" href="<?php echo $paginator->setFirstUrlPage(); ?>">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <li class="page-item active"><a class="page-link" href="<?php if($page <= 1){ echo "#";} else { echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$paginator->getPage());}?>">1</a></li>
        <?php for($i=2;$i<$totalPage;$i++): ?>
        <li class="page-item"><a class="page-link" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$i)?>"><?php echo $i ?></a></li>
        <?php endfor ?>
        <li class="page-item">
          <a class="page-link" aria-label="Next" href="<?php echo $paginator->setLastUrlPage(); ?>">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    
</div>