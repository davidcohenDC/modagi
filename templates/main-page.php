<?php
$page = $paginator->getPage();
$totalPage = $paginator->getTotalPages();
$tabelle = array();

array_push($tabelle, "marca","genere","materiale","colore","taglia");
$selected_css = "font-weight-bold text-primary";
$deleteSelectionHtml = '
  <section id="delete-filter">
  <button type="button" class="btn-delete btn btn-light" name="btnDelete"><i class="fa fa-trash fa-2x mr-2" aria-hidden="true"></i>Elimina Selezione</button>
  </section>
  ';
?>

<!-- Link: Home Style Css -->
<link href="<?php echo CSS_FILE . "home.css" ?>" rel="stylesheet">

<div class="row">

  <!-- Column: Filters -->
  <div class="filters col-lg-3 desktop">

    <!-- Section: Order-Filter -->
    <section id="order-filter">
      <h6>Ordina</h6>
      <div class="list-group">
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","ultimi_arrivi")?>">
        <label class="<?php if(isset($_GET["filter"]) && $_GET["filter"] == "ultimi_arrivi") {echo $selected_css ;}?>">Ultimi Arrivi</label></a>
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_crescente")?>">
        <label class="<?php if(isset($_GET["filter"]) && $_GET["filter"] == "prezzo_decrescente") {echo $selected_css ;}?>">Prezzo Crescente</label></a>
        <a href="<?php echo addURLParameters($_SERVER["REQUEST_URI"], "filter","prezzo_decrescente")?>">
        <label class="<?php if(isset($_GET["filter"]) && $_GET["filter"] == "prezzo_decrescente") {echo $selected_css ;}?>">Prezzo Decrescente</label></a>
      </div>
    </section>
    <!-- Section: Order-Filter -->

    <!-- Section: Price-Filter -->
    <section id="price-filter">
      <h6>Prezzo</h6>
      <div id="range-wrapper">
        <span for="multi">€0</span>
        <form class="multi-range-form">
          <input id="multi" class="multi-range" type="range" min="1" max="500" step="10" />
        </form>
        <span for="multi">€500</span>
      </div>
    </section>
    <!-- Section: Price-Filter -->


    <section id="tables-filter">
      <?php foreach($tabelle as $tabella): ?>
      <section class="list-<?php echo $tabella ?>">
        <a class="link-table" data-toggle="collapse" href="#collapse_<?php echo $tabella ?>">
          <h6><?php echo ucfirst($tabella) ?>
          <span class="fa fa-arrow-<?php if(isset($_GET[$tabella])) {echo "down";} else {echo "right";} ?>" aria-hidden="true"></span>
          </h6>
        </a>
          <?php foreach($templateParams[$tabella] as $value): ?>
          <div id="collapse_<?php echo $tabella ?>" class="custom-control collapse <?php if(isset($_GET[$tabella])) {echo "show";} ?>">
            <input type="radio" class="custom-control-input"
              id="<?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?>"
              name="check<?php echo ucfirst($tabella) ?>" value="<?php echo $value["id"] ?>"
              <?php if(isset($_GET[$tabella]) && $_GET[$tabella] == $value["id"]){echo "checked";}?>>
            <label
              class="<?php if(isset($_GET[$tabella])) {if($_GET[$tabella] == $value["id"]) {echo $selected_css;}} ?> custom-control-label"
              for="<?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?>"><?php if($tabella == "taglia") {echo $value["numero"];} else {echo $value["nome"];} ?></label>
          </div>
          <?php endforeach ?>
      </section>
      <?php endforeach ?>
    </section>
    <!-- Section: Tables-Filter -->

    <!-- Section: Delete-Filter -->
    <?php if($_GET) { echo $deleteSelectionHtml;} ?>
    <!-- Section: Delete-Filter -->
  </div>
  <!-- Column: Filters -->

  <!-- Column: Product -->
  <div class="col-12 col-lg-8">

    <!-- Section: Promotions-->
    <section id="promotions">
      <div id="carouselPromotion" class="carousel slide " aria-labelledby="id_title" data-ride="carousel" aria-describedby="id_desc">
      <h2 id="id_title" class="sr-only">Carousel content with slides.</h2>
      <p id="id_desc" class="sr-only">A carousel is a rotating set of images,
        rotation stops on keyboard focus on carousel tab controls or hovering the mouse pointer over images.</p>
        <div class="carousel-inner">
          <?php foreach($templateParams["Promo"] as $index => $promo):
          $prodotto = $product->selectByName($promo)[0]; ?>
          <div class="carousel-item <?php if ($index == 0) { echo "active";} ?>">
            <img class="d-block img-fluid" src="<?php echo PROMOTION_DIR."promo_".$promo.".jpg"; ?>" alt="Promozione <?php echo $prodotto["nome"] ?>">
              <div class="carousel-caption text-center">
              <h3><?php echo strtoupper($prodotto["nome"]);?></h3>
                <p><?php if($prodotto["descrizione"] != "") {echo $prodotto["descrizione"];} else {echo "aggiungi descrizione!";}?></p>
                <p><a class="btn btn-dark" href="product.php?prodotto=<?php echo $prodotto["id"]; ?>" role="button">Scopri 
                  <span class="fa fa-long-arrow-right" aria-hidden="true"></span></a></p>                
            </div>
          </div>
          <?php endforeach ?>
        </div>
      </div>
    </section>
      <!-- Section: Promotions-->

    <!-- Row: Filters -->
    <div class="row justify-content-center mobile">

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
      <button type="button" class="btn-delete btn btn-light" name="btnDelete"><i class="fa fa-trash fa-2x mr-2" aria-hidden="true"></i>Elimina Selezione</button>
      </div>
      ';} ?>
    <!-- Row: Filters -->

    <!-- Row: Product -->
    <div class="row">
      <?php foreach($templateParams["prodotti"] as $prodotto): ?>
      <!-- Column: Product -->
      <div class="products col-6 col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="product.php<?php echo "?prodotto=".$prodotto["id"]; ?>">
              <img class="card-img-top <?php  if($prodotto["stock"] == 0) echo 'not-available'?>" src="<?php echo IMG_DIR."/".$prodotto["nome"].".jpg"; ?>" alt="Scarpa <?php echo $prodotto["nome"]?>">
              <?php if($prodotto["stock"] == 0) echo '<span class="product-badge badge-dark" aria-label="non disponibile">ESAURITO</span>'?>
              <?php if(checkValueInArray($templateParams["migliori"],"idProdotto",$prodotto['id'])) echo '<span class="product-badge badge-warning" aria-label="consigliato">CONSIGLIATO</span>'?>
            </a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="product.php<?php echo "?prodotto=".$prodotto["id"]; ?>"><?php echo $prodotto["nome"]; ?></a>
              </h4>
              <h5>€<?php echo $prodotto["prezzo"] ?></h5>
              <p class="card-text tablet"><?php echo $prodotto["descrizione"]; ?></p>
            </div>
            <div class="card-footer">
              <small class="text-muted">Disponibilità: <?php echo $prodotto["stock"];?></small>
            </div>
          </div>
      </div>
      <!-- Column: Product -->
      <?php endforeach ?>
    </div>
    <!-- Row: Product -->

    <!-- Nav: Paginator -->
    <div class="row d-flex justify-content-center">
    <nav>
      <ul class="pagination pg-dark">
        <li class="page-item ">
          <a class="page-link " aria-label="Previous"
            href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",1);?>">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
          </a>
        </li>
        <?php for($i=1;$i<=$totalPage;$i++): ?>
        <li class="page-item <?php if($page == $i){echo "active";} ?>">
          <a class="page-link" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$i)?>"><?php echo $i ?></a>
        </li>
        <?php endfor ?>
        <li class="page-item">
          <a class="page-link" aria-label="Next" href="<?php echo addURLParameter($_SERVER['REQUEST_URI'], "pag",$totalPage);?>">
            <span aria-hidden="true">&raquo;</span>
            <span class="sr-only">Next</span>
          </a>
        </li>
      </ul>
    </nav>
    <!-- Nav: Paginator -->
    </div>
    <!-- Nav: Paginator -->
  </div>
  <!-- Column: Product -->
</div>