<?php

require 'db_connection.php';

// Get book's id
$bookId = $_GET['id'];

//
if(isset($bookId)){

    // Get book's title
    $querySelect = "SELECT * FROM book WHERE id = $bookId;";
    $book = mysqli_fetch_assoc(mysqli_query($mysqli, $querySelect));
    var_dump($querySelect,$book['title']);
    if (!isset($book)){
        header('location:index.php');
    }

    // Delete book
    $queryDelete = "DELETE FROM book WHERE id = $bookId";
    $deletedBook = mysqli_query($mysqli, $queryDelete);
    var_dump($deletedBook);
    
    // Feedback
    if($deletedBook){
        echo
        '<div>
            <h3>Bravo !</h3>
            <p>Le livre ' . $book['title'] . ' a bien été supprimé !<br/>
                <a href="index.php"><button>Retour à la liste des livres</button></a>
            </p>
        </div>';
    }
}

?>