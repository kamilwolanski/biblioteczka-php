<?php
require_once("connection.php");

if (isset($_GET['id'])) {
    $bookId = $_GET['id'];
    $result = mysqli_query(
        $conn,
        sprintf(
            "DELETE FROM books WHERE id = '%s'",
            mysqli_real_escape_string($conn, $bookId)
        )
    );

    if ($result) {
        $deletedRows = $conn->affected_rows;
        if ($deletedRows > 0) {
            echo "Rekordy zostały usunięte.";
        } else {
            echo "Nie znaleziono rekordów do usunięcia.";
        }
    } else {
        echo "Coś poszło nie tak";
    }

    header("Location: ../books.php");
    exit();
} else {
    header("Location: ../books.php");
    exit();
}
?>
