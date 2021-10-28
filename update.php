<?php

require 'db_connection.php';

if (isset($_POST['submit'])) {
    $id =  intval($_POST['book_id']);
    $title = addslashes($_POST['title']);
    $authorId = intval($_POST['author_id']);
    $categoryId = intval($_POST['category_id']);
    $publication_date = $_POST['publication_date'];
    $summary = addslashes($_POST['summary']);

    // Run request
    $querySelect = "SELECT * FROM book WHERE id = $id;";
    $book = mysqli_fetch_assoc(mysqli_query($mysqli, $querySelect));

    $queryUpdate = "UPDATE book
            SET  title ='$title',
            author_id = $authorId,
            category_id = $categoryId,
            publication_date='$publication_date',
            summary='$summary'
            WHERE book.id =$id";
    $editedBook = mysqli_query($mysqli, $queryUpdate);

    //if query run successfully, it will be redirected to viewbooks.php
    if ($editedBook) {
        $message = '<div>
                        <h2>Bravo !</h2>
                        <p>Le livre ' . $book['title'] . ' a bien été modifié !<br/>
                            <a href="index.php"><button>Retour à la liste des livres</button></a>
                        </p>
                    </div>';
        echo $message;
    } else {
        echo 'Result don\'t find !';
    }
    

}

?>