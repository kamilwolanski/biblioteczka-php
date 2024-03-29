<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: books.php');
    exit();
}

require_once("connection.php");


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['fr_email'] = $email;

    if (empty($email)) {
        $_SESSION['email-error'] = "Email jest wymagany";
    }

    if (empty($password)) {
        $_SESSION['password-error'] = "Hasło jest wymagane";
    }

    if (!empty($email) && !empty($password)) {

        $email = htmlentities($email, ENT_QUOTES, "UTF-8");

        $result = mysqli_query(
            $conn,
            sprintf(
                "select * from users where email = '%s'",
                mysqli_real_escape_string($conn, $email)
            )
        );


        if ($result) {
            $count = mysqli_num_rows($result);

            if ($count == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if (password_verify($password, $row['password'])) {
                    $_SESSION['logged'] = true;
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['name'] = $row['name'];

                    $result->free_result();
                    header('Location: books.php');
                } else {
                    $_SESSION['showAlert'] = true;
                }

            } else {
                $_SESSION['showAlert'] = true;
            }
        } else {
            echo 'Coś poszło nie tak';
        }
    }

    $conn->close();
}

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
            echo "<div> <a class=\"btn btn-light\" href=$mainUr1 role=\"button\"><img src=\"img/main.png\" width=\"70\" height=\"auto\"></a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<div> <a class=\"btn btn-light\" href=$booksUr1 role=\"button\">Twoje Ksiązki</a></div>";
            }
            echo "<div> <a class=\"btn btn-light\" href=$contactUr1 role=\"button\">Kontakt</a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<div><a class=\"btn btn-success\" href=$logoutUrl role=\"button\">Wyloguj</a></div>";
            } else {
                echo "<a class=\"btn btn-success\" href=$loginUr1 role=\"button\">Zaloguj się</a>";
            }
            ?>

    </nav>

    <div class="container pt-5 mt-5">
        <h1 class="text-center">Zaloguj się</h1>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="alert alert-danger fade" role="alert" id="incorrectLoginDetails">
                    Nieprawidłowy login lub hasło. Spróbuj ponownie
                </div>
                <form name="form" method="post" action="login.php" class="shadow">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="login" placeholder="Email" name="email" value="<?php
                        if (isset($_SESSION['fr_email'])) {
                            echo $_SESSION['fr_email'];
                            unset($_SESSION['fr_email']);
                        }
                        ?>">
                        <?php
                        if (isset($_SESSION['email-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['email-error'] . '</div>';

                            unset($_SESSION['email-error']);

                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" id="password" placeholder="Hasło" name="password">
                        <?php
                        if (isset($_SESSION['password-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['password-error'] . '</div>';

                            unset($_SESSION['password-error']);

                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Zaloguj</button>
                </form>
                <div class="text-center mt-5">
                    <a href="registration.php" class="link-primary">Załóż darmowe konto!</a>
                </div>
                <div class="text-center mt-5">
                    <a href="recoverPassword.php" class="link-primary">Odzyskaj hasło</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const showAlert = "<?php echo $_SESSION['showAlert'] ?>";
        if (showAlert) {
            document.querySelector("#incorrectLoginDetails").classList.add("show")

            <?php
            unset($_SESSION['showAlert']);
            ?>
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