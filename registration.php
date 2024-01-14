<?php
session_start();

if (isset($_POST['email'])) {

    $ok = true;
    $name = $_POST['name'];

    if ((strlen($name) < 2) || (strlen($name) > 20)) {
        $ok = false;
        $_SESSION['name-error'] = "Imię musi posiadać od 2 do 20 znaków!";
    }

    $email = $_POST['email'];
    $emailAfterSanitization = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($emailAfterSanitization, FILTER_VALIDATE_EMAIL) == false || ($emailAfterSanitization != $email))) {
        $ok = false;
        $_SESSION['email-reg-error'] = "Podaj poprawny adres e-mail";
    }

    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    if ((strlen($password1) < 8 || (strlen($password1) > 20))) {
        $ok = false;
        $_SESSION['password1-reg-error'] = 'Hasło musi posiadać od 8 do 20 znaków!';
    }

    if ($password1 != $password2) {
        $ok = false;
        $_SESSION['password1-reg-error'] = 'Podane hasła nie są identyczne!';
    }

    $password_hash = password_hash($password1, PASSWORD_DEFAULT);

    $_SESSION['fr_name'] = $name;
    $_SESSION['fr_email'] = $email;
    $_SESSION['fr_password1'] = $password1;
    $_SESSION['fr_password2'] = $password2;

    require_once("connection.php");

    mysqli_report(MYSQLI_REPORT_OFF);

    try {
        $result = $conn->query("SELECT id FROM users WHERE email='$email'");

        if (!$result)
            throw new Exception($conn->error);

        $emailsCount = $result->num_rows;

        if ($emailsCount > 0) {
            $ok = false;
            $_SESSION['email-reg-error'] = "Istnieje już konto przypisane do tego adresu email";
        }

        if ($ok == true) {

            if ($conn->query("INSERT INTO users VALUES (NULL, '$name', '$email', '$password_hash')")) {
                $_SESSION['registration_success'] = true;
                header('Location: welcome.php');
            } else {
                throw new Exception($conn->error);
            }
        }

        $conn->close();
    } catch (Exception $e) {
        echo '<span style="color:red;">Błąd serwera!<span>';
        echo $e->getCode();
        echo $e->getMessage();
    }

}


$showAlert = isset($_SESSION['showAlert']) ? true : false;
unset($_SESSION['showAlert']);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domowa biblioteka - Załóż darmowe konto!</title>
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
        <h1 class="text-center">Moja Biblioteka</h1>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="alert alert-danger fade" role="alert" id="incorrectLoginDetails">
                    Nieprawidłowy login lub hasło. Spróbuj ponownie
                </div>
                <form method="post" class="shadow">
                    <div class="form-group">
                        <label for="name">Imię</label>
                        <input type="text" class="form-control" id="name" placeholder="Imię" name="name" value="<?php
                        if (isset($_SESSION['fr_name'])) {
                            echo $_SESSION['fr_name'];
                            unset($_SESSION['fr_name']);
                        }
                        ?>">
                        <?php
                        if (isset($_SESSION['name-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['name-error'] . '</div>';

                            unset($_SESSION['name-error']);

                        }
                        ?>
                    </div>
                    <div class=" form-group">
                        <label for="email">E-mail</label>
                        <input type="email" class="form-control" id="email" placeholder="E-mail" name="email" value="<?php
                        if (isset($_SESSION['fr_email'])) {
                            echo $_SESSION['fr_email'];
                            unset($_SESSION['fr_email']);
                        }
                        ?>">
                        <?php
                        if (isset($_SESSION['email-reg-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['email-reg-error'] . '</div>';

                            unset($_SESSION['email-reg-error']);
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="password1">Hasło</label>
                        <input type="password" class="form-control" id="password1" placeholder="Hasło" name="password1">
                        <?php
                        if (isset($_SESSION['password1-reg-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['password1-reg-error'] . '</div>';

                            unset($_SESSION['password1-reg-error']);

                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="password2">Powtórz hasło</label>
                        <input type="password" class="form-control" id="password2" placeholder="Powtórz hasło"
                            name="password2">
                        <?php
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Zarejestruj się</button>
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