<?php
session_start();

if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
    header('Location: books.php');
    exit();
}

require_once("connection.php");
require_once("mailService.php");

if (isset($_SESSION['mailService'])) {
    $mailService = unserialize($_SESSION['mailService']);
} else {
    $mailService = new MailService("");
    $_SESSION['mailService'] = serialize($mailService);
}

if (isset($_POST['submit'])) {

    if ($mailService->email != $_POST['email']) {
        $_SESSION['email'] = $_POST['email'];
        // echo "<script>console.log('Email is: " . $_SESSION['email'] . "' );</script>";
        if ($mailService->email != $_SESSION['email']) {
            $mailService = new MailService($_SESSION['email']);
            $_SESSION['mailService'] = serialize($mailService);
        }
        $mailService->sendToken();
        // $mailService->printEmail();
        // $mailService->printToken();
    } else {
        // echo "<script>console.log('Token is: " . $_SESSION['token'] . "' );</script>";
        $_SESSION['token'] = $_POST['token'];
        if ($mailService->verifyToken($_SESSION['token'])) {
            $basePath = dirname($_SERVER['SCRIPT_NAME']);
            $setPasswordUrl = $basePath . '/setPassword.php';
            echo "<script>console.log('URL is: " . $setPasswordUrl . "' );</script>";
            header('Location: ' . $setPasswordUrl);
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
        <h1 class="text-center">Udzyskaj hasło</h1>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <form name="form" method="post" action="recoverPassword.php" class="shadow">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="login" placeholder="Email" name="email" value="<?php
                        if (isset($_SESSION['email'])) {
                            echo $_SESSION['email'];
                        }
                        ?>">
                        <?php
                        if (isset($_SESSION['email-error'])) {
                            echo '<div class="invalid-feedback d-block">' . $_SESSION['email-error'] . '</div>';

                            unset($_SESSION['email-error']);

                        }
                        ?>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Wyślij kod</button>
                    <div class="form-group">
                        <label for="authToken">Kod autoryzacji</label>
                        <input type="token" class="form-control" id="authToken" placeholder="Kod" name="token" value="<?php
                        if (isset($_SESSION['token'])) {
                            echo $_SESSION['token'];
                            unset($_SESSION['token']);
                        }
                        ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Sprawdź kod</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>