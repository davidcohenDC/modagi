<?php
$page = $paginator->getPage();
$totalPage = $paginator->getTotalPages();
$firstPage = 1;

$tabelle = array();
array_push($tabelle, "marca","genere","materiale","colore","taglia");
$promotions = array();


?>

<div class="row">

  <div class="col-lg-3 desktop">

    <!-- Section: Ordered -->
    <section class="list-order my-2 mb-4">
      <h6 class="font-weight-bold mb-3">Ordina</h6>
      <div class="list-group">
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","ultimi_arrivi")?>"><label
            class="control-label mb-1 <?php if($_GET["filter"] == "ultimi_arrivi") {echo "font-weight-bold text-primary";} else {}?>">Ultimi
            Arrivi</label></a>
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_crescente")?>"><label
            class="control-label mb-1 <?php if($_GET["filter"] == "prezzo_crescente") {echo "font-weight-bold text-primary";} else {}?>">Prezzo
            Crescente</label></a>
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_decrescente")?>"><label
            class="control-label mb-1 <?php if($_GET["filter"] == "prezzo_decrescente") {echo "font-weight-bold text-primary";} else {}?>">Prezzo
            Decrescente</label></a>
      </div>
    </section>
    <!-- Section: Ordered -->

    <!-- Section: Price -->
    <section class="list-price my-2 mb-4">

      <h6 class="font-weight-bold mb-3">Prezzo</h6>

      <div class="slider-price d-flex align-items-center my-4">
        <span class="font-weight-bold small text-muted mr-2">€0</span>
        <form class="multi-range-field mr-2 ">
          <input id="multi" class="multi-range" type="range" min="1" max="500" step="10" />
        </form>
        <span class="final-value font-weight-bold text-muted small">€500</span>
      </div>

    </section>
    <!-- Section: Price -->

    <!-- Section: Tables -->
    <section class="list-tables my-2 mb-4">
      <?php foreach($tabelle as $tabella): ?>
      <section class="list-gender mb-3">
        <a class="link-table" data-toggle="collapse" href="#collapse_<?php echo $tabella ?>">
          <h6 class="font-weight-bold mb-3"><?php echo ucfirst($tabella) ?><i
              class="ml-1 fa fa-arrow-<?php if(isset($_GET[$tabella])) {echo "down";} else {echo "right";} ?>" aria-hidden="true"></i>
      </h6>
        </a>
        <?php foreach($templateParams[$tabella] as $value): ?>
        <div id="collapse_<?php echo $tabella ?>"
          class="custom-control radio collapse <?php if($_GET[$tabella]) {echo "show";} ?>">
          <input type="radio" class="custom-control-input"
            id="<?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?>"
            name="check<?php echo ucfirst($tabella) ?>" value="<?php echo $value["id"] ?>"
            <?php if(isset($_GET[$tabella]) && $_GET[$tabella] == $value["id"]){echo "checked";}?>>
          <label
            class="<?php if($_GET[$tabella] == $value["id"]) {echo "font-weight-bold text-primary";} ?> custom-control-label mb-1"
            for="<?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?>"><?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?></label>
        </div>
        <?php endforeach ?>
      </section>
      <?php endforeach ?>

    </section>
    <!-- Section: Tables -->
    <?php if($_GET) { echo '
    <div class="row mb-3">
    <button type="button" class="btn-delete btn btn-light" name="btndelete"><i class="fa fa-trash fa-2x mr-2" aria-hidden="true"></i>Elimina Selezione</button>
    </div>
    ';} ?>
  </div>

  <div class="col-12 col-lg-8">
    
    <div id="carouselPromotion" class="carousel slide mb-4 " data-ride="carousel">
      <div class="carousel-inner" role="listbox">
        <?php foreach($templateParams["Promo"] as $index => $promo): ?>
          <?php 
          $productInPromo = getProductPromotion($promo);
          $prodotto = $product->selectByName($productInPromo)[0]; 
          ?>
        <div class="carousel-item <?php if ($index == 0) { echo "active";} ?>">
            <img class="d-block img-fluid" src="<?php echo $promo; ?>" alt="">
              <div class="carousel-caption text-center">
              <h2 class="text-dark"><?php echo strtoupper($prodotto["nome"]) ?></h2>
                <p class="text-dark desktop"><?php if($prodotto["descrizione"] != "") {echo $prodotto["descrizione"];} else {echo "aggiungi descrizione!";}?></p>
                <p><a class="btn btn-dark" href="product.php?prodotto=<?php echo $prodotto["id"]; ?>" role="button">Scopri</a></p>                
            </div>
        </div>
        <?php endforeach ?>
      </div>
    </div>

    <div class="row d-flex justify-content-center mobile">

      <div class="col-12 dropdown ml-2 mr-2">
        <button
          class=" btn-filter btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET["filter"])) { echo "active font-weight-bold text-primary";}?>"
          type="button" name="checkMarca1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
          aria-expanded="false"><?php if(isset($_GET["filter"])) { echo str_replace("_"," ",strtoupper(($_GET["filter"]))) ;} else { echo "Ordina";};?>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item"
            href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","ultimi_arrivi")?>"><label
              data-value="ultimiArrivi" class="dropdown-item">Ultimi Arrivi</label></a>
          <a class="dropdown-item"
            href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_crescente")?>"><label
              data-value="prezzoCrescente" class="dropdown-item">Prezzo Crescente</label></a>
          <a class="dropdown-item"
            href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_decrescente")?>"><label
              data-value="prezzoDecrescente" class="dropdown-item">Prezzo Decrescente</label></a>
        </div>
      </div>

      <?php foreach($tabelle as $str_tabella): ?>
      <div class="dropdown ml-1 mr-1">
        <button
          class="btn-filter btn btn-light dropdown-toggle mb-4 ml-2 <?php if(isset($_GET[$str_tabella])) { echo "active font-weight-bold text-primary";}?>"
          type="button" name="check<?php echo $str_tabella ?>" id="dropdownMenuButton" data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"><?php if(isset($_GET[$str_tabella])) { if($str_tabella == "taglia") {echo strtoupper($templateParams[$str_tabella][$_GET[$str_tabella]-1]["numero"]);} else 
          {echo strtoupper($templateParams[$str_tabella][$_GET[$str_tabella]-1]["nome"]);}} else { echo ucfirst($str_tabella);};?></button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <?php foreach($templateParams[$str_tabella] as $value): ?>
          <a class="dropdown-item"
            href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], $str_tabella,$value["id"])?>"><label
              data-value="<?php echo $value["id"] ?>"
              class="dropdown-item"><?php if($str_tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?></label></a>
          <?php endforeach ?>
        </div>
      </div>
      <?php endforeach ?>
    </div>

    <?php if($_GET) { echo '
    <div class="row justify-content-center mb-3 mobile">
    <button type="button" class="btn-delete btn btn-light" name="btndelete"><i class="fa fa-trash fa-2x mr-2" aria-hidden="true"></i>Elimina Selezione</button>
    </div>
    ';} ?>

    <div class="row">
      <?php foreach($templateParams["prodotti"] as $prodotto): ?>
      <div class="col-6 col-lg-4 col-md-6 mb-4">
        <div class="card h-100">

          <a href="product.php<?php echo "?prodotto=".$prodotto["id"]; ?>">
            <img class="card-img-top" src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg"; ?>" alt=""></a>
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

    <!-- Nav: Paginator -->
    <div class="row d-flex justify-content-center.">
    <nav>
      <ul class="pagination pg-dark">
        <li class="page-item ">
          <a class="page-link " aria-label="Previous"
            href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$firstPage);?>">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($i=1;$i<=$totalPage;$i++): ?>
        <li class="page-item <?php if($page == $i){echo "active";} ?>"><a class="page-link"
            href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$i)?>"><?php echo $i ?></a></li>
        <?php endfor ?>
        <li class="page-item">
          <a class="page-link" aria-label="Next"
            href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$totalPage);?>">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    </div>
    <!-- Nav: Paginator -->
  </div>