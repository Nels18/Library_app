<?php

require 'db_connection.php';

if (isset($_POST['submit'])) {
    $id =  intval($_POST['book_id']);
    $title = $_POST['title'];
    $authorId = intval($_POST['author_id']);
    $categoryId = intval($_POST['category_id']);
    $publication_date = $_POST['publication_date'];
    $summary = $_POST['summary'];

    // Run request
    $query = "UPDATE book
            SET  title ='$title',
            author_id = $authorId,
            category_id = $categoryId,
            publication_date='$publication_date',
            summary='$summary'
            WHERE book.id =$id";
    $result = mysqli_query($mysqli, $query);

    //if query run successfully, it will be redirected to viewbooks.php
    if ($result) {
        $message = '<div>
                        <h2>Bravo !</h2>
                        <p>Le livre a bien été modifié !<br/>
                            <a href="index.php">Retour à la liste des livres</a>
                        </p>
                    </div>';
        echo $message;
    } else {
        echo 'Result don\'t find !';
    }
    

}

?>