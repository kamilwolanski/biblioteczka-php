<?php
session_start();

if (!isset($_POST['title']) || !isset($_POST['author']) || !$_SESSION['userId']) {
    header("Location: books.php");
    exit();
}
require_once("connection.php");

if (isset($_POST['submit'])) {
    $bookId = $_POST['bookId'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publicationYear = $_POST['publication_year'];
    $description = $_POST['description'];

    $result = mysqli_query(
        $conn,
        sprintf(
            "UPDATE books SET title = '%s', author = '%s', publication_year = '%s', description = '%s' WHERE id = '%s'",
            mysqli_real_escape_string($conn, $title),
            mysqli_real_escape_string($conn, $author),
            mysqli_real_escape_string($conn, $publicationYear),
            mysqli_real_escape_string($conn, $description),
            mysqli_real_escape_string($conn, $bookId)
        )
    );

    if ($result == true) {
        header('Location: books.php');
        exit();
    } else {
        echo "Błąd: " . $conn->error;
    }
} else {
    echo "";
}
?>