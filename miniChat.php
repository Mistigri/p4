<?php

session_start();

?>

<!DOCTYPE html>
<html>

    <head>
        <title>Mini-chat</title>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet"> 
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <h1>Bienvenue sur notre chat !</h1>
        <form class="formChat" action="miniChat/miniChat_post.php" method="post">
        <p>
            <label for="pseudo">Pseudo : 
                <input type="text" 
                <?php                                 
                if (isset($_SESSION['pseudo'])) { 
                    echo 'value="' . $_SESSION['pseudo'] . '"';
                }
                ?>
                name="pseudo" id="form_pseudo"/>
            </label><br/>
            <label for="message">Message : 
                <input type="textarea" name = "message" id="form_message"/>
            </label><br/>
            <input type="submit" value="Envoyer" />
        </p>
        </form>

        <?php
        // Connexion à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
        }

        catch(Exception $e) {
                die('Erreur : '.$e->getMessage());
        }

        // Récupération des 10 derniers messages
        $reponse = $bdd->query('SELECT DATE_FORMAT(date_message, \'%d/%m/%Y %Hh%i\') AS date_message,pseudo, message FROM minichat ORDER BY ID DESC LIMIT 0, 10');

        // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
        while ($donnees = $reponse->fetch()) {
            echo '<p class = "post"><div id = "date_message">' . htmlspecialchars($donnees ['date_message']). '</div><div id = "pseudo_post_message">' . htmlspecialchars($donnees['pseudo']) . '</div><div id = "post_message">' . htmlspecialchars($donnees['message']) . '</div></p>';
        }

        $reponse->closeCursor();
        ?>

    </body>
</html>