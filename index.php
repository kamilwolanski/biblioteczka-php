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
            $loginUr1 = $basePath . '/loginmain.php';
            $booksUr1 = $basePath . '/books.php';
            $contactUr1 = $basePath . '/contact.php';
            $mainUr1 = $basePath . '/index.php';
            echo "<div> <a class=\"btn btn-default\" href=$mainUr1 role=\"button\"><img src=\"img/main.png\" width=\"70\" height=\"auto\"></a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)){
                echo "<div> <a class=\"btn btn-default\" href=$booksUr1 role=\"button\">Twoje Ksiązki</a></div>";
            }
            echo "<div> <a class=\"btn btn-default\" href=$contactUr1 role=\"button\">Kontakt</a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)){
                echo "<div><a class=\"btn btn-default\" href=$logoutUrl role=\"button\">Wyloguj</a></div>";
            }else{
                echo "<a class=\"btn btn-default\" href=$loginUr1 role=\"button\">Zaloguj się</a>";
            }
            ?>
        
    </nav>
        <?php
        if((isset($_SESSION['user']))){
        echo "<div style=\"max-width:100%;\" class=\"row justify-content-center\">";
        echo "<div class=\"col-sm-11 col-md-8 basic-info\">";
        echo "<h3>Witaj " . $_SESSION['user'] . "<br>Cieszymy się, że jesteś z nami. Życzymy udanych doświadczeń i korzystania z naszej platformy.</h1>";
        echo "</div></div>";
        }
        ?>
        <div style="max-width:100%;" class="row justify-content-center">
            <div class="col-sm-11 col-md-8 basic-main">
            <div class="col-sm-8 bs1"><span>📚 Odkryj Świat Literatury z WorldCat! 🌍

Czy kiedykolwiek marzyłeś o możliwości przeszukiwania największego globalnego zbioru książek? WorldCat to brama do nieograniczonego świata literatury, gdzie miliony książek z tysięcy bibliotek na całym świecie są na wyciągnięcie ręki!</span></div>
            <div class="col-sm-4 bs2"><a href="https://search.worldcat.org/"><img id="fotografia" src="img/books.jpg"></a></div>
            </div>
        </div>
    </div>
    <script>
        const showAlert = "<?php echo $showAlert ?>";
        if (showAlert) {
            document.querySelector("#incorrectLoginDetails").classList.add("show")
        } 
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>
</body>

</html>