<?php

function read()
{
    require_once 'db_connection.php';
    
    // Run request
    $query = "SELECT b.id, b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
    INNER JOIN author a ON a.id = b.author_id
    INNER JOIN category c ON c.id = b.category_id
    ORDER BY id
    ;";
    $result = mysqli_query($mysqli, $query
    );

    // Fetch result
    while ($book = mysqli_fetch_assoc($result)) {
        $btnEdit = '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 24 24" width="24px" height="24px">    <path d="M 19.171875 2 C 18.448125 2 17.724375 2.275625 17.171875 2.828125 L 16 4 L 20 8 L 21.171875 6.828125 C 22.275875 5.724125 22.275875 3.933125 21.171875 2.828125 C 20.619375 2.275625 19.895625 2 19.171875 2 z M 14.5 5.5 L 3 17 L 3 21 L 7 21 L 18.5 9.5 L 14.5 5.5 z"/></svg>';

        echo '<tr>';
        echo    '<td>' . $book["id"] . '</td>';
        echo    '<td>' . $book["title"] . '</td>';
        echo    '<td>' . $book["firstname"]. ' ' . $book["lastname"] . '</td>';
        echo    '<td>' . $book["category"] . '</td>';
        echo    '<td>' . $book["publication_date"] . '</td>';
        echo    '<td>' . $book["summary"] . '</td>';
        echo    '<td><a href="edit_book.php?id=' . $book["id"] . '"><button>' . $btnEdit . '</button></a></td>';
        echo '</tr>';
    }
};

