<?php
require 'db_connection.php';

// If form is being submitted, get the values from $_POST array
if (isset($_POST['submit'])) {
    $author_id = intval($_POST['author_id']);
    $category_id = intval($_POST['category_id']);
    $title = addslashes(htmlspecialchars($_POST['title']));
    $publication_date = $_POST['publication_date'];
    $summary = addslashes(htmlspecialchars($_POST['summary']));
    
    // Run request
    $query = "INSERT INTO book (author_id, category_id, title, publication_date, summary) VALUES ($author_id, $category_id, '$title', '$publication_date', '$summary');";

    $result = mysqli_query($mysqli, $query);
    var_dump($query,$result);

    //if query run successfully, it will be redirected to viewbooks.php
    if ($result) {
        echo 'Result find';
        header('location:index.php');
    } else {
        echo 'Result don\'t find !';
    }
}
?>