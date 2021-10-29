<?php
    require 'db_connection.php';
    require 'create.php';
    $queryAuthors = "SELECT a.id, a.firstname, a.lastname FROM author a;";
    $authors = mysqli_query($mysqli, $queryAuthors);
    $queryCategories = "SELECT c.id, c.name category FROM category c;";
    $categories = mysqli_query($mysqli, $queryCategories);

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
        <form action="create.php" method="post" class="form_info">
            <div>
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" required>
            </div>
            
            <div>
                <label for="author">Auteur</label>
                <select name="author_id" id="author" required>
                    <option value="null">Sélectionner un auteur</option>
                    <?php
                        while ($author = mysqli_fetch_assoc($authors)) {
                            echo '<option value="'
                            . $author["id"] .
                            '">' . $author["firstname"] . ' ' . $author["lastname"] .
                            '</option>';
                        }
                    ?>
                </select>
            </div>
            
            <div>
                <label for="category">Genre</label>
                <select name="category_id" id="category" required>
                    <option value="null">Sélectionner un genre</option>
                    <?php
                        while ($category = mysqli_fetch_assoc($categories)) {
                            echo '<option value="'
                            . $category["id"] . '">' . $category["category"] .
                            '</option>';
                        }
                    ?>
                </select>
            </div>

            <div>
                <label for="publication_date">Date de parution</label>
                <input type="date" name="publication_date" id="publication_date" required>
            </div>

            <div>
                <label for="summary">Résumé :</label>
                <textarea name="summary" id="summary" cols="80" rows="10"></textarea>
            </div>
            
            <input type="submit" name="submit" value="Ajouter le livre">
        </form>    
        <a href="index.php"><button>Annuler l'ajout</button></a>
    </main>
</body>
</html>