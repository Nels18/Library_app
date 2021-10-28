<?php
    require 'db_connection.php';
    require 'update.php';
    $queryAuthor = "SELECT a.id, a.firstname, a.lastname FROM author a;";
    $resultAuthor = mysqli_query($mysqli, $queryAuthor);
    $queryCategory = "SELECT c.id, c.name category FROM category c;";
    $resultCategory = mysqli_query($mysqli, $queryCategory);

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
        var_dump($book);
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
        <h1>Modifier un livre</h1>
    </header>
    <main>
        <form action="update.php" method="post">
            <div>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" value= <?= $book['title'] ;?> required>
            </div>
            
            <div>
                <label for="author">Auteur :</label>
                <select name="author_id" id="author" required>
                    <option value="null">Sélectionner un auteur</option>
                    <?php
                        while ($author = mysqli_fetch_assoc($resultAuthor)) {
                            echo ($author["id"] == $book['author_id'])

                            ?'<option value="' . $author["id"] . '"' . 'selected' . '>' . $author["firstname"] . ' ' . $author["lastname"] . '</option>'

                            :'<option value="' . $author["id"] . '">' . $author["firstname"] . ' ' . $author["lastname"] . '</option>';
                        }
                    ?>
                </select>
            </div>
            
            <div>
                <label for="category">Genre :</label>
                <select name="category_id" id="category" required>
                    <option value="null">Sélectionner un genre</option>
                    <?php
                        while ($category = mysqli_fetch_assoc($resultCategory)) {
                            echo ($category["id"] == $book['category_id'])

                            ?'<option value="' . $category["id"] . '"' . 'selected' . '>' . $category["category"] . '</option>'

                            :'<option value="' . $category["id"] . '">' . $category["category"] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <div>
                <label for="publication_date" required>Date de parution :</label>
                <input type="date" name="publication_date" id="publication_date" value= <?= $book['publication_date'] ;?> >
            </div>

            <div>
                <label for="summary">Résumé :</label>
                <textarea name="summary" id="summary" cols="80" rows="10" ><?= $book['summary'] ;?> </textarea>
            </div>
            
            <input type="hidden" name="book_id" value= <?= $bookId ;?> >
            <input type="submit" name="submit" value="Modifier le livre">
            <a href="update.php"><button>Annuler</button></a>
        </form>    
    </main>
</body>
</html>