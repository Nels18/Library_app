<?php 
    require_once 'read.php';
    require_once 'db_connection.php';

    $nbBook = mysqli_fetch_assoc(mysqli_query($mysqli,
    "SELECT COUNT(*) as total FROM book"
    ));


    @$page = $_GET['page'];
    if (is_null($page)) {
        $page = 1;
    }
    $nbBookPerPage = 5;
    $nbPages = ceil($nbBook['total'] / $nbBookPerPage);
    $offset = ($page - 1) * $nbBookPerPage;
    $paginationRequest = " LIMIT " . $offset . ',' . $nbBookPerPage;
    
    function getPagination($nbBookPerPage, $page) {
        for ($i=1; $i <= $nbBookPerPage; $i++) {
            if ($page != $i) {
                echo '<a href="?page=' . $i . '"><button class="btn_pagination">' . $i .' </button></a>';
            } else {
                echo '<span><button class="btn_pagination inactive">' . $i .' </button></span>';
            }
            
        }
    }

        

    // Run request
    if (isset($_GET['search_submit'])) {  // If user run a search
        // Search request
        $searches = explode(' ',trim($_GET['search']));
        $publicationDate = $_GET['publication_date'];

        $searchResult = "SELECT b.id, b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
        INNER JOIN author a ON a.id = b.author_id
        INNER JOIN category c ON c.id = b.category_id";

        foreach ($searches as $search) {
            if (0 == array_search($search, $searches)) {
                $searchResult .= " WHERE (b.title LIKE '%$search%'";
            } else {
                $searchResult .= " OR b.title LIKE '%$search%'";
            }
        }
        $searchResult .= ")";

        if ('0' !== $publicationDate) {
            $searchResult .= " AND b.publication_date LIKE '$publicationDate%'";
        }
        $searchResult .= " ORDER BY id";
        $searchResult .= $paginationRequest;
        $searchResult .= ";";
        $searches = addslashes(str_replace('%', ' ', (implode('%',$searches))));

    } else {  // If user don't run a search show all books
        $allBooks = "SELECT b.id, b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
        INNER JOIN author a ON a.id = b.author_id
        INNER JOIN category c ON c.id = b.category_id
        ORDER BY id " . $paginationRequest . "
        ;";
    }

    // Get all dates of publication
    $queryDates = "SELECT YEAR(publication_date) as pubDate FROM book GROUP BY pubDate ORDER BY pubDate;";
    $publicationDates = mysqli_query($mysqli, $queryDates);

?>
<!DOCTYPE html>
<html lang='fr'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<meta http-equiv='X-UA-Compatible' content='ie=edge'>
<meta name='description' content='Ma Bibliothèque'/>
<link rel='stylesheet' href='style.css'>
<title>Ma Bibliothèque</title>
</head>
<body>
    <header>
        <h1>Ma bibliothèque</h1>
    </header>
    <main class="container">
        <h2>Liste des livres</h2>
        <form action="index.php" method="get" class="form_search">
            <div class="form_group">
                <label for="search">Recherche : </label>
                <div>
                    <input type="search" name="search" id="search">
                    <input type="submit" name="search_submit" value="Rechercher">
                </div>
            </div>
            <div class="form_group">
                <label for="publication_date">Filtrer par année :</label>
                <select name="publication_date" id="publication_date" required>
                    <option value="0">Sélectionner une année pour la recherche</option>
                    <?php
                        while ($publicationDate = mysqli_fetch_assoc($publicationDates)) {
                            $publicationDate = $publicationDate['pubDate'];
                            echo '<option value="' . $publicationDate . '"' . '>' . $publicationDate . '</option>';
                        }
                    ?>
                </select>
            </div>
        </form>
        <?php

            if (isset($_GET['search_submit']) && '' !== $_GET['search']) {
            echo '<div>
                <p> Résultat pour : '
                    . $searches . 
                '</p>
                <p>
                    <a href="index.php"><button>Afficher tous les livres</button></a>
                </p>
            </div>';
            }
            ?>
            <div class="pagination_control">
                <?php
                    getPagination($nbBookPerPage, $page);
                ?>
            </div>
        <table class='book_table'>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Genre</th>
                    <th>Date de parution</th>
                    <th>Résumé</th>
                    <th>Modifier</th>
                    <th>Supprimer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($_GET['search_submit']) && 'Rechercher' == $_GET['search_submit']) {
                        read($mysqli,$searchResult);
                    } else {
                        read($mysqli,$allBooks);
                    }
                ?>
            </tbody>
        </table>
        <a href="form_book.php"><button class="btn_primary">Ajouter un livre</button></a>
        <div class="pagination_control"><?php getPagination($nbBookPerPage, $page); ?></div>
    </main>
</body>
</html>
