<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
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
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- link for icons -->
</head>

<body>
    <header class="mb-4">
        <div class=" mt-3 text-center">
            <h1><?php echo SHOP_NAME ?></h1>
            <p>Mission, Vission & Values</p>
        </div>
    </header>

    <nav class="navbar navbar-expand-md navbar-dark text-center scrolling-navbar ">
        <div class="container-fluid">

            <!-- Brand -->
            <a class="navbar-brand" href="index.php">
                <i class="fa fa-odnoklassniki mr-3" aria-hidden="true"></i>SHOES COM
            </a>

            <!-- Collapse button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                        <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                    </svg>
                </span>
            </button>

            <!-- Links -->
            <div class="collapse navbar-collapse" id="basicExampleNav">

                <!-- Right -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link waves-effect">
                            HOME
                        </a>
                    </li>
                    <?php require_once("./utilis/functions.php"); ?>
                    <?php if (isUserLoggedIn()) : ?>
                        <li class="nav-item">
                            <div class="nav-link waves-effect">
                                <?php require_once("notification.php"); ?>
                            </div>
                        </li>
                    <?php endif ?>
                    <li class="nav-item">
                        <a href="cart.php" class="nav-link navbar-link-2 waves-effect">
                            <span class="badge badge-pill red">
                                <?php
                                require_once("./utilis/CartManager.php");
                                $cartManager = new CartManager(DB_SERVER_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
                                echo $cartManager->getOrderCount();
                                ?>
                            </span>
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="user-page.php" class="nav-link waves-effect">
                            <?php require_once("./utilis/functions.php"); ?>
                            <?php if (isUserLoggedIn()) : ?>
                                <?php echo $_SESSION["username"]; ?>
                            <?php else : ?>
                                Log in
                            <?php endif ?>
                        </a>
                    </li>
                    <li class="nav-item pl-2 mb-2 mb-md-0">
                        <?php if (isUserLoggedIn()) : ?>
                            <a href="user-action-page.php?action=0" type="button" class="btn btn-outline-danger btn-md btn-rounded btn-navbar waves-effect waves-light">
                                Log out
                            </a>
                        <?php else : ?>
                            <a href="registration-page.php" type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light">
                                Sign up
                            </a>
                        <?php endif ?>
                    </li>
                </ul>

            </div>
            <!-- Links -->
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
    <footer class="py-4 bg-dark">
        <div class="col-md-2 col-lg-3">
            <!--empty space-->
        </div>
        <div class="py-4 container bg-light-dark col-12 col-md-8 col-lg-6">
            <h6 class="px-5 m-0 text-white">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                    </svg>
                </span> Contatti
            </h6>
            <div>
                <?php
                $creators = CREATORS;
                shuffle($creators);
                ?>
                <dl class="row text-light pt-3 px-5">
                    <?php foreach ($creators as $creator) : ?>
                        <dt class="col-12 col-md-6 py-2">
                            <?php echo $creator["nome"] . " " . $creator["cognome"] ?>
                        </dt>
                        <dd class="col-12 col-md-6 value py-2">
                            <?php echo $creator["email"] ?>
                        </dd>

                        <hr />
                    <?php endforeach ?>
                </dl>
            </div>
        </div>
        <div class="col-md-2 col-lg-3">
            <!--empty space-->
        </div>
        <div class="py-5 container">
            <p class="m-0 text-center text-white ">Copyright &copy; Your Website 2020</p>
        </div>
    </footer>
</body>

</html>