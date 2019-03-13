<!DOCTYPE html>
<html>

    <head>
        <title>Blog</title>
        <meta charset="utf-8" />
        <link href="https://fonts.googleapis.com/css?family=Oxygen" rel="stylesheet"> 
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
        <h1>Mon super blog !</h1>

        <p>Derniers billets du blog :</p>

        <?php
        // Connexion à la base de données
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        }

        catch(Exception $e) {
                die('Erreur : '.$e->getMessage());
        }

        // On récupère les 5 derniers billets
        $req = $bdd->query('SELECT id_post, post_title, post_content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');

        while ($datas = $req->fetch()) {
        ?>

        <div class="news">
            <h3>
                <?php echo htmlspecialchars($datas['post_title']); ?>
                <em>le <?php echo $datas['date_post_fr']; ?></em>
            </h3>

             <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($datas['post_content']));
            ?>
            <br />

            <em><a href="comments.php?post=<?php echo $datas['id_post']; ?>">Commentaires</a></em>
            </p>
        </div>

        <?php
        } // Fin de la boucle des billets
        $req->closeCursor();
        ?>

    </body>
</html>