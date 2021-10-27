<?php
    require 'db_connection.php';
    require 'lists_options_selects.php';
    require 'create.php';
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
        <h1>Ajouter un livre</h1>
    </header>
    <main>
        <form action="create.php" method="post">
            <div>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required>
            </div>
            
            <div>
                <label for="author">Auteur</label>
                <select name="author_id" id="author" required>
                    <option value="null">Sélectionner un auteur</option>
                    <?php
                        echo listAuthor($mysqli);
                    ?>
                </select>
            </div>
            
            <div>
                <label for="category">Genre</label>
                <select name="category_id" id="category" required>
                    <option value="null">Sélectionner un genre</option>
                    <?php
                        echo listCategory($mysqli);
                    ?>
                </select>
            </div>

            <div>
                <label for="publication_date" required>Date de parution</label>
                <input type="date" name="publication_date" id="publication_date">
            </div>

            <div>
                <label for="summary"></label>
                <textarea name="summary" id="summary" cols="30" rows="10"></textarea>
            </div>
            
            <input type="submit" name="submit" value="Ajouter le livre">
        </form>    
    </main>
</body>
</html>