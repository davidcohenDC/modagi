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
    <header class="jumbotron">
        <div class="container text-center">
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
                    <a class="nav-link" href="user-page.php">
                        <?php require_once("./utilis/functions.php"); ?>
                        <?php if (isUserLoggedIn()) : ?>
                            <?php echo $_SESSION["username"] . " "; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm9.854-2.854a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                            </svg>
                        <?php else : ?>
                            <?php echo "Log-in "; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg>
                        <?php endif ?>
                    </a>
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
    <footer class="py-4 bg-dark">
        <div class="col-md-2 col-lg-3">
            <!--empty space-->
        </div>
        <div class="py-4 container bg-light-dark col-12 col-md-8 col-lg-6">
            <h5 class="px-5 m-0 text-white">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
                        <path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z" />
                    </svg>
                </span> Contatti
            </h5>
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