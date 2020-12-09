<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--page title-->
    <title><?php echo $templateParams["title"]; ?></title>
    <!--bootstrap include-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
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