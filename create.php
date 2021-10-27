<?php
var_dump($_POST);
require 'db_connection.php';


//if form is being submitted, get the values from $_POST array
if (isset($_POST['submit'])) {
    $author_id = intval($_POST['author_id']);
    $category_id = intval($_POST['category_id']);
    $title = $_POST['title'];
    $publication_date = $_POST['publication_date'];
    $summary = $_POST['summary'];
    
    //create a query to insert values into table ‘books’.
    $query = "INSERT INTO book (author_id, category_id, title, publication_date, summary) VALUES ($author_id, $category_id, '$title', '$publication_date', '$summary');";

    //execute query
    $result = mysqli_query($mysqli, $query);

    //if query run successfully, it will be redirected to viewbooks.php
    if ($result) {
        echo 'Result find';
        header('location:index.php');
    } else {
        echo 'Result don\'t find !';
    }
}
?>