<?php
    session_start();

    // if (isset($_SESSION['cart'])) {
    //     session_unset();
    //     session_destroy();
    // }
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
            <h2>Mon panier</h2>
            <?php

                if (isset($_POST['book_title']) && 0 < $_POST['nb_book']) {
                    $book_title = $_POST['book_title'];
                    $nb_book = $_POST['nb_book'];
                    $_SESSION['cart'][$book_title] = intval($nb_book);
                    header("location:cart.php");
                }

                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $book => $quantity) {
                        echo
                        '<form action="' . htmlspecialchars($_SERVER["PHP_SELF"]) . '" method="post">
                            <p>' . $book . ' : 
                            <input type="number" min="0" name="nb_book" id="nb_book" value="' . $quantity . '">
                            <input type="hidden" name="book_title" value="' . $book . '">
                            <input type="submit" value="Valider">
                        </form></p>';
                    }
                }
            ?>
            <div class="btn_cancel">
                <a href="index.php">
                    <button class="btn_danger">Retour à l'accueil</button>
                </a>
            </div>
        </main>
    </body>
</html>

