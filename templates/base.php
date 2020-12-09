<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <!--TODO: reusable header -->
    </header>
    <nav>
        <!--TODO: link to other pages -->
    </nav>
    <main>
        <!--main content-->
        <?php
            if(isset($templateParams["main"])){
                require($templateParams["main"]);
            }
        ?>
    </main>
    <footer>
        <!--TODO: reusable footer -->
    </footer>
</body>
</html>