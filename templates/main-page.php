<?php
$page = $paginator->getPage();
$totalPage = $paginator->getTotalPages();
$firstPage = 1;

if(isset($_GET["marca"])) {
  $tagmarca = $brand->selectByID($_GET["marca"])[0];
} else {
  $tagmarca = "";
}

if(isset($_GET["genere"])) {
  $tag_genere = $gender->selectbyID($_GET["genere"])[0];
} else {
  $tag_genere = "";
}

if(isset($_GET["materiale"])) {
  $tag_materiale = $material->selectbyID($_GET["materiale"])[0];
} else {
  $tag_materialee = "";
}

if(isset($_GET["colore"])) {
  $tag_colore = $colour->selectbyID($_GET["colore"])[0];
} else {
  $tag_colore = "";
}
 
?>

<div class="row">

  <div class="col-lg-3 desktop-show">

<!--     <section class="list-brand mb-4">
      <h6 class="font-weight-bold mb-3">SELECTION</h6>
      <?php foreach($params as $param=>$value): ?>
      <div class="custom-control radio">
      <label class="custom-control-label mb-1" for="<?php echo $param["marca"] ?>" ><?php echo $product->selectMarcaByID($value)[0]["nome"]; ;  ?></label>
      </div>
      <?php endforeach ?>
      <div>
      <a class=" mb-1" href="">remove Selection</a>
      </div>
    </section> -->

    <section class="list-gender mb-4">
      <h6 class="font-weight-bold mb-3">-- Genere --</h6>
      <?php foreach($templateParams["generi"] as $genere): ?>
      <div class="custom-control radio">
      <input type="radio" class="custom-control-input" id="<?php echo $genere["nome"] ?>" name="checkGenere" value="<?php echo $genere["id"] ?>" 
      <?php if(isset($_GET["genere"]) && $_GET["genere"] == $genere["id"]){echo "checked";}?>>
      <label class="custom-control-label mb-1" for="<?php echo $genere["nome"] ?>"><?php echo $genere["nome"] ?></label>
      </div>
      <?php endforeach ?>
    </section>

    <section class="list-material mb-4">
      <h6 class="font-weight-bold mb-3">-- Materiale --</h6>
      <?php foreach($templateParams["materiali"] as $materiale): ?>
        <div class="custom-control radio">
        <input type="radio" class="custom-control-input" id="<?php echo $materiale["nome"] ?>" name="checkMateriale" value="<?php echo $materiale["id"] ?>"
        <?php if(isset($_GET["materiale"]) && $_GET["materiale"] == $materiale["id"]){echo "checked";}?>>
        <label class="custom-control-label mb-1" for="<?php echo $materiale["nome"] ?>"><?php echo $materiale["nome"] ?></label>
      </div>
      <?php endforeach ?>
    </section>

    <section class="list-material mb-4">
      <h6 class="font-weight-bold mb-3">-- Colore --</h6>
      <?php foreach($templateParams["colori"] as $colore): ?>
        <div class="custom-control radio">
        <input type="radio" class="custom-control-input" id="<?php echo $colore["nome"] ?>" name="checkColore" value="<?php echo $colore["id"] ?>"
        <?php if(isset($_GET["colore"]) && $_GET["colore"] == $colore["id"]){echo "checked";}?>>
        <label class="custom-control-label mb-1" for="<?php echo $colore["nome"] ?>"><?php echo $colore["nome"] ?></label>
      </div>
      <?php endforeach ?>
    </section>
  </div>

  <div class="col-lg-8">

    <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      </ol>

      <div class="carousel-inner" role="listbox">
      <?php for($i = 0;$i <$templateParams["promozioni"]; $i++):?> 
      <div class="carousel-item <?php if($i==0) {echo " active";}?>">
        <a href="product.php?prodotto=10"><img class="d-block img-fluid" src="<?php echo PROMOTION_DIR."promotion".$i.".jpg" ?>" alt=""></a>
          
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



    <div class="row justify-content-center">

    <div class="dropdown">
    <button class="btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET["marca"])) { echo "active font-weight-bold";}?>" type="button" name="checkMarca1" 
    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_GET["marca"])) { echo strtoupper($tagmarca["nome"]);} else { echo "Marca";};?></button>
   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <?php foreach($templateParams["marca"] as $marca): ?>
    <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "marca",$marca["id"])?>"><label data-value="<?php echo $marca["id"] ?>" class="dropdown-item" ><?php echo $marca["nome"] ?></label></a>
  <?php endforeach ?>
  </div>
  </div>
  <div class="dropdown">
    <button class="btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET["genere"])) { echo "active font-weight-bold";}?>" type="button" name="checkMarca1" 
    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_GET["genere"])) { echo strtoupper($tag_genere["nome"]);} else { echo "Genere";};?></button>
   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <?php foreach($templateParams["generi"] as $genere): ?>
    <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "genere",$genere["id"])?>"><label data-value="<?php echo $genere["id"] ?>" class="dropdown-item" ><?php echo $genere["nome"] ?></label></a>
  <?php endforeach ?>
  </div>
  </div>
  <div class=" dropdown">
    <button class="btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET["materiale"])) { echo "active font-weight-bold";}?>" type="button" name="checkMarca1" 
    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_GET["materiale"])) { echo strtoupper($tag_materiale["nome"]);} else { echo "Materiale";};?></button>
   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <?php foreach($templateParams["materiali"] as $materiale): ?>
    <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "materiale",$materiale["id"]);?>"><label data-value="<?php echo $materiale["id"] ?>" class="dropdown-item" ><?php echo $materiale["nome"] ?></label></a>
  <?php endforeach ?>
  </div>
  </div>
  <div class=" dropdown">
    <button class="btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET["colore"])) { echo "active font-weight-bold";}?>" type="button" name="checkMarca1" 
    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php if(isset($_GET["colore"])) { echo strtoupper($tag_colore["nome"]);} else { echo "Colore";};?></button>
   <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <?php foreach($templateParams["colori"] as $colore): ?>
    <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "colore",$colore["id"])?>"><label data-value="<?php echo $colore["id"] ?>" class="dropdown-item" ><?php echo $colore["nome"] ?></label></a>
  <?php endforeach ?>
  </div>
  </div>
   </div>
   <div class="row">

      <?php foreach($templateParams["prodotti"] as $prodotto): ?>
      <div class="col-6 col-lg-4 col-md-6 mb-4">
        <div class="card h-100">
          <a href="product.php<?php echo "?prodotto=".$prodotto["id"]; ?>"><img class="card-img-top" src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg"; ?>" alt=""></a>
          <div class="card-body">
            <h4 class="card-title">
              <a href="product.php<?php echo "?prodotto=".$prodotto["id"]; ?>"><?php echo $prodotto["nome"]; ?></a>
            </h4>
            <h5>€<?php echo $prodotto["prezzo"] ?></h5>
            <p class="card-text"><?php echo $prodotto["descrizione"]; ?></p>
          </div>
          <div class="card-footer">
            <small class="text-muted">Disponibilità: <?php echo $prodotto["stock"];?></small>
          </div>
        </div>
      </div>
      <?php endforeach ?>

    </div>

    <nav>
      <ul class="pagination pg-dark">
        <li class="page-item " >
          <a class="page-link " aria-label="Previous" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$firstPage);?>">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($i=1;$i<=$totalPage;$i++): ?>
        <li class="page-item <?php if($page == $i){echo "active";} ?>"><a class="page-link" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$i)?>"><?php echo $i ?></a></li>
        <?php endfor ?>
        <li class="page-item">
          <a class="page-link" aria-label="Next" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$totalPage);?>">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
</div>
