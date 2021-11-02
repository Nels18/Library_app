
<?php

require 'db_connection.php';

// Get book's id
$bookId = $_GET['id'];

if(isset($bookId)){

    // Get book's title
    $querySelect = "SELECT * FROM book WHERE id = $bookId;";
    $book = mysqli_fetch_assoc(mysqli_query($mysqli, $querySelect));

    if (!isset($book)){
        header('location:index.php');
    }

    // Delete book
    $queryDelete = "DELETE FROM book WHERE id = $bookId";
    $deletedBook = mysqli_query($mysqli, $queryDelete);
    
    // Feedback
    if($deletedBook){
        echo 'Result find';
        header('location:confirmation.php?title='. $book['title'] . '&action=delete');
    }
}