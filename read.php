<?php

function read()
{
    $servername = "localhost";
    $username = "root";
    
    $br = '<br>';
    
    // Create connection
    $mysqli = mysqli_connect($servername, $username);
    
    
    // Select bdd
    mysqli_select_db($mysqli, "books_app");
    
    // Run request
    $query = "SELECT b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
    JOIN author a ON a.id = b.author_id
    JOIN category c ON c.id = b.category_id
    ;";
    
    $result = mysqli_query($mysqli, $query
    );

    // Fetch result
    while ($book = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $book["title"] . '</td>';
        echo '<td>' . $book["firstname"]. ' ' . $book["lastname"] . '</td>';
        echo '<td>' . $book["category"] . '</td>';
        echo '<td>' . $book["publication_date"] . '</td>';
        echo '<td>' . $book["summary"] . '</td>';
        echo '</tr>';
    }
};

