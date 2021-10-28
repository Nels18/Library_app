<?php 
    require_once 'read.php';
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
                read();
            ?>
        </tbody>
    </table>
    <a href="add_book.php"><button>Ajouter un livre</button></a>
    </main>
</body>
</html>