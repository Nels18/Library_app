<?php 
    session_start();

    if (isset($_POST['userName'])) {
        $_SESSION['userName'] = $_POST['userName'];
        header("location:index.php");
    }
    
    if (isset($_SESSION['userName'])) {
        header("location:index.php");
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
        <main class="container">
            <h2>Connection</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="form_info">
                <div class="form_group">
                    <label for="name">Nom :</label>
                    <input id="name" type="text" name="userName">
                </div>
                <input type="submit" value="Se connecter">
            </form>
            <div class="btn_cancel">
                <a href="index.php">
                    <button class="btn_danger">Retour à l'accueil</button>
                </a>
            </div>
        </main>
    </body>
</html>
