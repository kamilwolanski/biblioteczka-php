<?php
session_start();


if (!isset($_SESSION['logged'])) {
    header('Location: index.php');
    exit();
}

require_once("connection.php");
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Domowa biblioteka - Lista książek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./styles/main2.css">
    <link rel="stylesheet" href="./styles/form.css">

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
                echo "<div> <a class=\"btn btn-success\" href=$booksUr1 role=\"button\">Twoje Ksiązki</a></div>";
            }
            echo "<div> <a class=\"btn btn-light\" href=$contactUr1 role=\"button\">Kontakt</a></div>";
            if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true)) {
                echo "<div><a class=\"btn btn-light\" href=$logoutUrl role=\"button\">Wyloguj</a></div>";
            } else {
                echo "<a class=\"btn btn-light\" href=$loginUr1 role=\"button\">Zaloguj się</a>";
            }
            ?>

    </nav>
    <main>
        <div class="container pt-5">
            <!-- Button trigger modal -->
            <?php
            if (!isset($_GET['id'])) {
                echo '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addBookModal" id="commonAddButton">
                    Dodaj
                </button>';
            }
            ?>

            <div class="row pt-4">
                <?php

                if (isset($_GET['id'])) {
                    $bookId = $_GET['id'];
                    $sql = "SELECT * FROM books WHERE id = '$bookId'";
                    $result = mysqli_query(
                        $conn,
                        sprintf(
                            "SELECT * FROM books WHERE id = '%s'",
                            mysqli_real_escape_string($conn, $bookId),
                        )
                    );
                    if ($result->num_rows > 0) {
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        $id = $row["id"];
                        $title = $row["title"];
                        $author = $row["author"];
                        $publicationYear = $row["publication_year"];
                        $description = $row["description"];
                        echo "
                            <div class=\"col-10 offset-1\">
                                <div class=\"row\">
                                    <div class=\"col\">
                                        <h1>
                                            $title
                                        </h1>
                                        <h2>
                                            $author
                                        </h2>
                                        <h3>
                                            $publicationYear
                                        </h3>
                                    </div>
                                    <div class=\"col\">
                                        <p>
                                            $description
                                        </p>
                                    </div>
                                </div>
                            </div>
                        ";
                    } else {
                        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                        header("Location: $url");
                    }
                } else {
                    $userId = htmlentities($_SESSION['userId']);
                    $sql = "SELECT * FROM books WHERE user_id = '$userId'";

                    $result = mysqli_query(
                        $conn,
                        sprintf(
                            "SELECT * FROM books WHERE user_id = '%s'",
                            mysqli_real_escape_string($conn, $userId),
                        )
                    );

                    // Sprawdzanie rezultatu zapytania
                    if ($result->num_rows > 0) {
                        // Wyświetlanie danych o książkach
                        while ($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $title = $row["title"];
                            $author = $row["author"];
                            $description = $row["description"];


                            $publicationYear = $row["publication_year"];
                            $truncated = truncateString($description, 101);

                            echo "
                                    <div class=\"mt-4 col-12 col-md-6 col-md-4 col-lg-3\">
                                        <div class=\"card shadow border-0 rounded-lg\">
                                            <div class=\"card-body\">
                                                <div class=\"d-flex justify-content-between\">
                                                    <h5 class=\"card-title\">$title</h5>
                                                    <a href=\"./deletebook.php/?id=$id\" class=\"bin text-danger\">
                                                        <i class=\"bi bi-trash3\"></i>
                                                    </a>
                                                </div>
                                                <h6 class=\"card-subtitle mb-2 text-muted\">$author</h6>
                                                <p class=\"card-text\">$truncated</p>
                                                <div class='d-flex justify-content-between'>
                                                    <a href=\"./books.php/?id=$id\" class=\"btn btn-info\">Szczegóły</a>
                                                    <button class=\"btn btn-warning\" data-toggle=\"modal\" data-target=\"#editBookModal\"
                                                    onClick=\"setForm($id, '$title', '$author', '$publicationYear', '$description')\" >Edytuj</button>
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                ";
                        }
                    } else {
                        echo "<script>
                        document.querySelector('#commonAddButton').style.display = 'none';
                        </script>";
                        echo "<div class='no-books px-5'>
                        <i class='bi bi-book'></i>
                        <h3 class='mb-5 text-center'>Dodaj swoją pierwszą książke!</h3>
                        <button type='button' class='btn btn-primary btn-lg' data-toggle='modal' data-target='#addBookModal'>
                    Dodaj
                </button>
                        </div>";
                    }
                }



                $conn->close();
                ?>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form name="form" method="post" action="./editbook.php" id="editForm">
                    <div class="modal-content border-0">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edytuj książkę</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="bookId" value="" id="bookId" />
                            <div class="form-group">
                                <label for="title">Tytuł</label>
                                <input type="text" class="form-control" id="title" placeholder="Tytuł książki"
                                    name="title">
                            </div>
                            <div class="form-group">
                                <label for="author">Autor</label>
                                <input type="text" class="form-control" id="author" placeholder="Autor" name="author">
                            </div>
                            <div class="form-group">
                                <label for="publication_year">Rok publikacji</label>
                                <input type="number" class="form-control" id="publication_year"
                                    placeholder="Rok publikacji" name="publication_year">
                            </div>
                            <div class="form-group">
                                <label for="description">Opis</label>
                                <textarea class="form-control" id="description" rows="3" maxlength="2000"
                                    name="description" placeholder="Opis książki"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer border-0">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                            <button type="submit" class="btn btn-primary" name="submit">Edytuj</button>
                        </div>
                </form>
            </div>
        </div>

    </main>



    <!-- Add Modal -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form name="form" method="post" action="./addbook.php">
                <div class="modal-content border-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Dodaj książkę</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Tytuł</label>
                            <input type="text" class="form-control" id="title" placeholder="Tytuł książki" name="title">
                        </div>
                        <div class="form-group">
                            <label for="author">Autor</label>
                            <input type="text" class="form-control" id="author" placeholder="Autor" name="author">
                        </div>
                        <div class="form-group">
                            <label for="publication_year">Rok publikacji</label>
                            <input type="number" class="form-control" id="publication_year" placeholder="Rok publikacji"
                                name="publication_year">
                        </div>
                        <div class="form-group">
                            <label for="description">Opis</label>
                            <textarea class="form-control" id="description" rows="3" maxlength="2000" name="description"
                                placeholder="Opis książki"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Zamknij</button>
                        <button type="submit" class="btn btn-primary" name="submit">Zapisz</button>
                    </div>
            </form>
        </div>
    </div>

    <script>
        const setForm = (bookId, title, author, publicationYear, description) => {
            const editForm = document.querySelector("#editForm");
            const inputTitle = editForm.querySelector("#title");
            const inputAuthor = editForm.querySelector('#author');
            const inputPublicationYear = editForm.querySelector('#publication_year');
            const inputDescription = editForm.querySelector('#description');
            const inputBookId = editForm.querySelector('#bookId');

            console.log('bookId', bookId);
            console.log('title', title);
            console.log('author', author)

            inputTitle.value = title;
            inputAuthor.value = author;
            inputPublicationYear.value = publicationYear;
            inputDescription.value = description;
            inputBookId.value = bookId;

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