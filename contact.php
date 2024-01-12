<?php
session_start();


?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domowa biblioteka - Logowanie</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/main2.css" type="text/css">
    <link rel="stylesheet" href="./styles/form.css" type="text/css">

</head>

<body>

    <nav class="navbar navbar-light bg-light">
        <div class="container">
            <?php
            $basePath = dirname($_SERVER['SCRIPT_NAME']);
            $logoutUrl = $basePath . '/logout.php';
            $loginUr1 = $basePath . '/login.php';
            $booksUr1 = $basePath . '/books.php';
            $contactUr1 = $basePath . '/contact.php';
            $mainUr1 = $basePath . '/index.php';
            echo "<div> <a class=\"btn btn-default\" href=$mainUr1 role=\"button\"><img src=\"img/main.png\" width=\"70\" height=\"auto\"></a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<div> <a class=\"btn btn-default\" href=$booksUr1 role=\"button\">Twoje Ksiązki</a></div>";
            }
            echo "<div> <a class=\"btn btn-default\" href=$contactUr1 role=\"button\">Kontakt</a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<div><a class=\"btn btn-default\" href=$logoutUrl role=\"button\">Wyloguj</a></div>";
            } else {
                echo "<a class=\"btn btn-default\" href=$loginUr1 role=\"button\">Zaloguj się</a>";
            }
            ?>

    </nav>
    <div style="max-width:100%;" class="row justify-content-center">
        <div class="col-sm-11 col-md-8 basic-info">
            <?php
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<h3>Witaj " . $_SESSION['name'] . "<br>Cieszymy się, że jesteś z nami. Jeżeli masz jakieś pytania lub problemy zapraszamy do kontaktu z nami!</h1>";
            } else {
                echo "<h3>Witaj na naszej stronie! <br>Cieszymy się, że jesteś z nami. Jeżeli masz jakieś pytania lub problemy zapraszamy do kontaktu z nami!</h1>";
            }
            ?>
        </div>
        <div class="col-sm-11 col-md-8 basic-info">

            <h3>E-mail: biblioteczka@gmail.com <br>Tel: +48 666 666 666 <br>Adres: Ul. Wiejska 4/6/8 00-902 Warszawa
            </h3>
        </div>
    </div>

</body>

</html>