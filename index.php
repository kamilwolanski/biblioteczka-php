<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: books.php');
    exit();
}

$showAlert = isset($_SESSION['showAlert']) ? true : false;
unset($_SESSION['showAlert']);
require_once("connection.php");
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
    <link rel="stylesheet" href="./styles/main.css" type="text/css">
    <link rel="stylesheet" href="./styles/form.css" type="text/css">

</head>

<body>

    <div class="container pt-5 mt-5">
        <h1 class="text-center">Moja Biblioteka</h1>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="alert alert-danger fade" role="alert" id="incorrectLoginDetails">
                    Nieprawidłowy login lub hasło. Spróbuj ponownie
                </div>
                <form name="form" method="post" action="login.php" class="shadow">
                    <div class="form-group">
                        <label for="login">Nazwa użytkownika</label>
                        <input type="text" class="form-control" id="login" placeholder="Nazwa użytkownika" name="login">
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" id="password" placeholder="Hasło" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Zaloguj</button>
                </form>
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