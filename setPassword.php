<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: books.php');
    exit();
}

require_once("connection.php");

if (isset($_POST['password1'])) {
    $ok = true;
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

    $_SESSION['password1'] = $password1;
    $_SESSION['password2'] = $password2;

    require_once("connection.php");

    mysqli_report(MYSQLI_REPORT_OFF);

    try {

        $result = $conn->query("SELECT id FROM users WHERE email='$email'");

        if (!$result) {
            throw new Exception($conn->error);
        }

        if ($ok == true) {

            if ($conn->query("UPDATE users SET password = '$password_hash' WHERE email = '$email'")) {
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
    <div class="container pt-5 mt-5">
        <h1 class="text-center">Ustaw nowe hasło</h1>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <form name="form" method="post" action="recoverPassword.php" class="shadow">
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
                    <button type="submit" class="btn btn-primary" name="submit">Zmień hasło</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>