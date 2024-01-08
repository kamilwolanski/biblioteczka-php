<?php
session_start();

if (!isset($_POST['title']) || !isset($_POST['author']) || !$_SESSION['userId']) {
    header("Location: books.php");
    exit();
}
require_once("connection.php");


if (isset($_POST['submit'])) {
    $userId = $_SESSION['userId'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publicationYear = $_POST['publication_year'];
    $description = $_POST['description'];

    $sql = "INSERT INTO books (user_id, title, author, publication_year, description) VALUES ('%s', '%s', '%s', '%s', '%s')";

    $result = mysqli_query(
        $conn,
        sprintf(
            "INSERT INTO books (user_id, title, author, publication_year, description) VALUES ('%s', '%s', '%s', '%s', '%s')",
            mysqli_real_escape_string($conn, $userId),
            mysqli_real_escape_string($conn, $title),
            mysqli_real_escape_string($conn, $author),
            mysqli_real_escape_string($conn, $publicationYear),
            mysqli_real_escape_string($conn, $description)
        )
    );

    if($result == true) {
        header('Location: books.php');
        exit();
    } else {
        echo "Błąd: " . $conn->error;
    }
} else {
    echo "";
}
?>