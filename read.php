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

        $btnDelete = '<svg fill="#000000" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 30 30" width="30px" height="30px">    <path d="M 14.984375 2.4863281 A 1.0001 1.0001 0 0 0 14 3.5 L 14 4 L 8.5 4 A 1.0001 1.0001 0 0 0 7.4863281 5 L 6 5 A 1.0001 1.0001 0 1 0 6 7 L 24 7 A 1.0001 1.0001 0 1 0 24 5 L 22.513672 5 A 1.0001 1.0001 0 0 0 21.5 4 L 16 4 L 16 3.5 A 1.0001 1.0001 0 0 0 14.984375 2.4863281 z M 6 9 L 7.7929688 24.234375 C 7.9109687 25.241375 8.7633438 26 9.7773438 26 L 20.222656 26 C 21.236656 26 22.088031 25.241375 22.207031 24.234375 L 24 9 L 6 9 z"/></svg>';

        echo '<tr>';
        echo    '<td>' . $book["id"] . '</td>';
        echo    '<td>' . $book["title"] . '</td>';
        echo    '<td>' . $book["firstname"]. ' ' . $book["lastname"] . '</td>';
        echo    '<td>' . $book["category"] . '</td>';
        echo    '<td>' . $book["publication_date"] . '</td>';
        echo    '<td>' . $book["summary"] . '</td>';
        echo    '<td><a href="edit_book.php?id=' . $book["id"] . '"><button>' . $btnEdit . '</button></a></td>';
        echo    '<td><a href="delete.php?id=' . $book["id"] . '"><button>' . $btnDelete . '</button></a></td>';
        echo '</tr>';
    }
};

