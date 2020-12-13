<?php 

if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}

$product = new Product("prodotto");
$product->setNumberOfRecordPerPage(6);
$offset = ($pageno-1) * $product->getNumberOfRecordPerPage();

$total_pages = $product->getTotalPages();
$templateParams["prodotti"] = $product->Pagination($offset);

?>

<!DOCTYPE html>
<html lang="it">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Shop Homepage</title>

  <!-- Bootstrap core CSS -->
  <link href="<?php echo BOOTSTRAP_CSS_LINK ?>" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="<?php echo CSS_FILE; ?>shop-homepage.css" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Start Bootstrap</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div class="container">

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
              <li><a href="?pageno=1">First</a></li>
              <li class="<?php if($pageno <= 1){ echo 'disable';} ?>">
                <a href="<?php if($pageno <= 1){ echo "#";} else { echo "?pageno=".($pageno-1);}?>">Prev</a>
              </li>
              <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
              </li>
              <li>
                <a href="?pageno=<?php echo $total_pages; ?>">Last</a>
              </li>
            </ul>
          </div>
        </div>

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="<?php echo JS_FILE ?>jquery/jquery.min.js"></script>
  <script src="<?php echo BOOTSTRAP_JS_LINK ?>"></script>

</body>

</html>
