<?php
    function listAuthor($mysqli)
    {
        $query = "SELECT a.id, a.firstname, a.lastname FROM author a;";
        $result = mysqli_query($mysqli, $query);
        
        while ($author = mysqli_fetch_assoc($result)) {
            echo '<option value="'
            . $author["id"] .
            '">' . $author["firstname"] . ' ' . $author["lastname"] .
            '</option>';
        }
    }
    
    function listCategory($mysqli)
    {
        $query = "SELECT c.id, c.name category FROM category c;";
        $result = mysqli_query($mysqli, $query);
    
        while ($category = mysqli_fetch_assoc($result)) {
            echo '<option value="'
            . $category["id"] . '">' . $category["category"] .
            '</option>';
        }
    }
?>