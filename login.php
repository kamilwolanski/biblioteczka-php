<?php
session_start();

if (!isset($_POST['email']) || !isset($_POST['password'])) {
    header("Location: index.php");
    exit();
}
require_once("connection.php");


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $_SESSION['fr_email'] = $email;

    if (empty($email)) {
        $_SESSION['email-error'] = "Email jest wymagany";
        header("Location: index.php");
    }

    if (empty($password)) {
        $_SESSION['password-error'] = "Hasło jest wymagane";
        header("Location: index.php");
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
                    $_SESSION['name'] = $row[''];

                    unset($_SESSION['showAlert']);
                    $result->free_result();
                    header('Location: books.php');
                } else {
                    $_SESSION['showAlert'] = true;
                    header("Location: index.php");
                }

            } else {
                $_SESSION['showAlert'] = true;
                header("Location: index.php");
            }
        } else {
            echo 'Coś poszło nie tak';
        }
    }

    $conn->close();
}

?>