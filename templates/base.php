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
    <!-- personal css file -->
    <?php if (isset($templateParams["cssFileName"])) : ?>
        <link href="<?php echo CSS_FILE . $templateParams["cssFileName"] ?>" rel="stylesheet">
    <?php endif ?>

    <script src="<?php echo BOOTSTRAP_JS_LINK ?>"></script>
    <script src="./js/home.js"></script>
    <!--base css file-->
    <link rel="stylesheet" href="<?php echo CSS_FILE; ?>base.css">

    <!-- link for icons -->

</head>

<body>
    <header class="jumbotron">
        <div class="container text-xs-center">
            <h1><?php echo SHOP_NAME ?></h1>
            <p>Mission, Vission & Values</p>
        </div>

    </header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Expand at md</a>
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user-page.php">Log-in</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-md-0">
                <input class="form-control" type="text" placeholder="Search">
            </form>
        </div>
    </nav>
    <main class="container">
        <!--main content-->
        <?php
        if (isset($templateParams["main"])) {
            require($templateParams["main"]);
        }
        ?>
    </main>
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
        </div>
    </footer>
</body>

</html>