<?php
session_start();

if (!isset($_POST['login']) || !isset($_POST['password'])) {
    header("Location: index.php");
    exit();
}
require_once("connection.php");


if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    $password = htmlentities($password, ENT_QUOTES, "UTF-8");

    $result = mysqli_query(
        $conn,
        sprintf(
            "select * from users where login = '%s' and password = '%s'",
            mysqli_real_escape_string($conn, $login),
            mysqli_real_escape_string($conn, $password)
        )
    );


    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            echo "znaleziono usera";
            $_SESSION['logged'] = true;
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $_SESSION['userId'] = $row['id'];
            $_SESSION['user'] = $row['login'];

            unset($_SESSION['showAlert']);
            $result->free_result();
            header('Location: index.php');

        } else {
            $_SESSION['showAlert'] = true;
            header("Location: loginmain.php");
        }
    } else {
        echo 'Coś poszło nie tak';
    }

    $conn->close();
}

?>