<?php
session_start();
require_once("mailService.php");


if (!isset($_SESSION['mailService'])) {
    header("location: index.php");
} else {
    $mailService = unserialize($_SESSION['mailService']);
    $mailService->printEmail();

    if ((isset($_POST['auth-code'])) && (isset($_POST["submit-code"]))) {
        $authCode = $_POST['auth-code'];
        $codeIsValid = $mailService->verifyToken($authCode);

        if ($codeIsValid) {
            require_once("connection.php");
            mysqli_report(MYSQLI_REPORT_OFF);

            try {
                $name = $_SESSION['name'];
                $email = $mailService->email;
                $password_hash = $_SESSION['password_hash'];

                if ($conn->query("INSERT INTO users VALUES (NULL, '$name', '$email', '$password_hash')")) {
                    $_SESSION['registration_success'] = true;
                    unset($_SESSION['mailService']);
                    unset($_SESSION['name']);
                    unset($_SESSION['password_hash']);
                    unset($_SESSION['showAlertAuthCode']);
                    header('Location: welcome.php');
                } else {
                    throw new Exception($conn->error);
                }
            } catch (Exception $e) {
                echo '<span style="color:red;">Błąd serwera!<span>';
                echo $e->getCode();
                echo $e->getMessage();
            }

            $conn->close();


        } else {
            $_SESSION['showAlertAuthCode'] = true;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domowa biblioteka - Aktywacja konta</title>
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
    <div class="container pt-5 mt-5">
        <h1 class="text-center">Wysłano kod autoryzacyjny na
            <?php echo $mailService->email ?>
        </h1>
        <h3 class="text-center mt-4">
            Wpisz kod autoryzacyjny, aby aktywować konto
        </h3>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="alert alert-danger fade" role="alert" id="incorrectAuthCode">
                    Nieprawidłowy kod aktywacyjny, spróbuj ponownie
                </div>
                <form method="post" class="shadow">
                    <div class=" form-group">
                        <label for="auth-code">Kod autoryzacyjny</label>
                        <input type="number" class="form-control" id="auth-code" placeholder="Kod autoryzacyjny"
                            name="auth-code">
                        <?php
                        if (isset($_SESSION['email-reg-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['email-reg-error'] . '</div>';

                            unset($_SESSION['email-reg-error']);
                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-code">Aktywuj konto</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>

    <script>
        const showAlert = "<?php echo $_SESSION['showAlertAuthCode'] ?>";
        console.log('showAlert', showAlert)
        if (showAlert) {
            document.querySelector("#incorrectAuthCode").classList.add("show")
        }
    </script>
</body>

</html>