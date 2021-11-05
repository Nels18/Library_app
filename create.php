<?php
require 'db_connection.php';

// If form is being submitted, get the values from $_POST array
if (isset($_POST['submit'])) {
    $authorId = intval($_POST['author_id']);
    $categoryId = intval($_POST['category_id']);
    $title = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['title']));
    $publication_date = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['publication_date']));
    $summary = htmlspecialchars(mysqli_real_escape_string($mysqli, $_POST['summary']));
    
    // Run request
    $query = "INSERT INTO book (author_id, category_id, title, publication_date, summary) VALUES ($authorId, $categoryId, '$title', '$publication_date', '$summary');";
    $createdBook = mysqli_query($mysqli, $query);

    //if query run successfully, it will be redirected to viewbooks.php
    if ($createdBook && ($authorId !== null || $categoryId !== null)) {
        header('location:confirmation.php?title='. $title . '&action=create');
    } else {
        header('location:form_book.php');
        echo 'Result don\'t find !';
    }
}