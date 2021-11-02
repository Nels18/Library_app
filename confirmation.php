<?php
    // Get book's id and action
        $title = $_GET['title'];
        $action = $_GET['action'];
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
        <div>
            <h3>Bravo !</h3>
            <p>
            Le livre  <?= $title ?> a bien été 
            <?php
                switch ($action) {
                    case 'create':
                        $action = 'crée';
                        break;
                    
                    case 'edit':
                        $action = 'modifié';
                        break;
                    
                    case 'delete':
                        $action = 'supprimé';
                        break;
                }
                echo $action;
            ?> !
            </p>
            <div>
                <a href="index.php">
                    <button class="btn_primary">Retour à la liste des livres</button>
                </a>
            </div>
        </div>
    </main>
    </body>
</html>