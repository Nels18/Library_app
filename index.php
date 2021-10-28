<?php 
    require_once 'read.php';

    // Run request

    if (isset($_GET['search_submit'])) {
        $search = addslashes(str_replace(' ', '%', trim($_GET['search'])));

        $searchResult = "SELECT b.id, b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
        INNER JOIN author a ON a.id = b.author_id
        INNER JOIN category c ON c.id = b.category_id
        WHERE b.title LIKE '%$search%'
        ORDER BY id";
    } else {
        $allBooks = "SELECT b.id, b.title, a.firstname, a.lastname, c.name category, b.publication_date, b.summary  FROM book b
        INNER JOIN author a ON a.id = b.author_id
        INNER JOIN category c ON c.id = b.category_id
        ORDER BY id
        ;";
    }
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
    <main>
        <form action="index.php" method="get">
            <label for="search">Recherche : </label>
            <input type="search" name="search" id="search">
            <input type="submit" name="search_submit" value="Rechercher">
        </form>
        <?php
            if (isset($_GET['search_submit']) && '' !== $_GET['search']) {
            echo '<div>
                <p> Résultat pour : '
                    . str_replace('%', ' ', $search) . 
                '</p>
                <p>
                    <a href="index.php"><button>Afficher tous les livres</button></a>
                </p>
            </div>';
            }
        ?>
        <table class='book_table'>
        <thead>
            <tr>
                <th>Id</th>
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
                    read($searchResult);
                } else {
                    read($allBooks);
                }
            ?>
        </tbody>
    </table>
    <a href="add_book.php"><button>Ajouter un livre</button></a>
    </main>
</body>
</html>
