<?php
    require 'db_connection.php';
    require 'create.php';
    require 'update.php';

    $queryAuthors = "SELECT a.id, a.firstname, a.lastname FROM author a;";
    $authors = mysqli_query($mysqli, $queryAuthors);
    $queryCategories = "SELECT c.id, c.name category FROM category c;";
    $categories = mysqli_query($mysqli, $queryCategories);
    
    if (isset($_GET['id'])) {
        // Get book's id
        $bookId = $_GET['id'];
    
        // Run request
        $query = "SELECT * FROM book WHERE id = $bookId;";
        $result = mysqli_query($mysqli, $query);
    
        // If 
        if ($result) {
            $num_books = mysqli_num_rows($result);
        } else {
            echo 'Result don\'t find !';
        }
    
        if ($num_books == 1) {
            $book = mysqli_fetch_assoc($result);
        }

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
    <div class="container">
        <header>
            <h1>Ma bibliothèque</h1>
        </header>
        <main>
            <?php
                echo (isset($_GET['id']))
                ? '<h2>Modifier un livre</h2>'
                : '<h2>Ajouter un livre</h2>'
            ?>
            <div class="btn_cancel">
                <a href="index.php">
                    <button class="btn_danger">
                    <?php
                        echo (isset($_GET['id']))
                        ? 'Annuler la modification'
                        : 'Annuler l\'ajout'
                    ?>
                    </button>
                </a>
            </div>
            <?php
                echo (isset($_GET['id']))
                ? '<form action="update.php" method="post" class="form_info">'
                : '<form action="create.php" method="post" class="form_info">'
            ?>
                <div class="form_bloc">
                    <div class="form_group">
                        <label for="title">Titre :</label>
                        <?php
                        echo (isset($_GET['id']))
    
                        ? '<input type="text" name="title" id="title" value="' . $book['title'] . '" required>'
    
                        : '<input type="text" name="title" id="title" required>';
    
                        ?>
                    </div>
                    
                    <div class="form_group">
                        <label for="author">Auteur :</label>
                        <select name="author_id" id="author" required>
                            <option value="">Sélectionner un auteur</option>
                            <?php
                                while ($author = mysqli_fetch_assoc($authors)) {
    
                                    echo ($author["id"] == $book['author_id'])
        
                                    ?'<option value="' . $author["id"] . '"' . 'selected' . '>' . $author["firstname"] . ' ' . $author["lastname"] . '</option>'
        
                                    :'<option value="' . $author["id"] . '">' . $author["firstname"] . ' ' . $author["lastname"] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="form_bloc">
                    <div class="form_group">
                        <label for="category">Genre :</label>
                        <select name="category_id" id="category" required>
                            <option value="">Sélectionner un genre</option>
                            <?php
                                while ($category = mysqli_fetch_assoc($categories)) {
                                    echo ($category["id"] == $book['category_id'] && $_GET['id'])
        
                                    ?'<option value="' . $category["id"] . '"' . 'selected' . '>' . $category["category"] . '</option>'
        
                                    :'<option value="' . $category["id"] . '">' . $category["category"] . '</option>';
                                }
                            ?>
                        </select>
                    </div>
        
                    <div class="form_group">
                        <label for="publication_date">Date de parution :</label>
                        <?php 
                        echo (isset($_GET['id']))
    
                        ? '<input type="date" name="publication_date" id="publication_date" value="' . $book['publication_date'] . '" required>'
    
                        : '<input type="date" name="publication_date" id="publication_date" required>'
                        ?>
                    </div>
                </div>
    
                <div class="form_group">
                    <label for="summary">Résumé :</label>
                    <?php 
                    echo (isset($_GET['id']))

                    ? '<textarea name="summary" id="summary" cols="80" rows="10" >' . $book['summary'] . '</textarea>'

                    : '<textarea name="summary" id="summary" cols="80" rows="10"></textarea>'
                    ?>
                </div>
                
                <?php
                    echo (isset($_GET['id']))
                    ? '<input type="hidden" name="book_id" value="' . $bookId .'" >
                    <input type="submit" name="submit" value="Modifier le livre">'
                    : '<input type="submit" name="submit" value="Ajouter le livre">'
                ?>
            </form>
        </main>
    </div>
</body>
</html>
