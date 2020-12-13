<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <meta name="author" content="">
    <!--page title-->
    <title><?php echo $templateParams["title"]; ?></title>
    <!--jquery include-->
    <script src="<?php echo JQUERY_LINK ?>"></script>
    <!--bootstrap include-->
    <link rel="stylesheet" href="<?php echo BOOTSTRAP_CSS_LINK ?>">
    <script src="<?php echo BOOTSTRAP_JS_LINK ?>"></script>
    <!--base css file-->
    <link rel="stylesheet" href="<?php echo CSS_FILE; ?>base.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo CSS_FILE.$templateParams["cssFileName"] ?>" rel="stylesheet">
</head>
<body>
    <header class="jumbotron">
        <div class="container text-center">
            <h1><?php echo SHOP_NAME ?></h1>
            <p>Mission, Vission & Values</p>
        </div>
    </header>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>                        
                </button>
                <a class="navbar-brand" href="#">Logo</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Deals</a></li>
                    <li><a href="#">Stores</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="container">
        <!--main content-->
        <?php
            if(isset($templateParams["main"])){
                require($templateParams["main"]);
            }
        ?>
    </main>
    <footer class="container-fluid text-center">
        <p>Online Store Copyright</p>  
        <form class="form-inline">Get deals:
            <input type="email" class="form-control" size="50" placeholder="Email Address">
            <button type="button" class="btn btn-danger">Sign Up</button>
        </form>
    </footer>
</body>
</html>