<?php
    session_start();

    if (!isset($_SESSION['userName'])) {
        header('location:index.php');
    }

    require 'db_connection.php';

    if (isset($_POST['submit'])) {
        $id =  intval($_POST['book_id']);
        $title = mysqli_real_escape_string($mysqli, $_POST['title']);
        $authorId = intval($_POST['author_id']);
        $categoryId = intval($_POST['category_id']);
        $publication_date = mysqli_real_escape_string($mysqli, $_POST['publication_date']);
        $summary = mysqli_real_escape_string($mysqli, $_POST['summary']);

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

        // If query run successfully, it will be redirected to viewbooks.php
        if ($editedBook && ($authorId !== null || $categoryId !== null)) {
            header('location:confirmation.php?title='. $title . '&action=edit');
        } else {
            header('location:form_book.php?id=' . $book["id"]);
            echo 'Result don\'t find !';
        }
    }