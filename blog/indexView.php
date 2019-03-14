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
        while ($data = $posts->fetch()) {
        ?>

        <div class="news">
            <h3>
                <?php echo htmlspecialchars($data['post_title']); ?>
                <em>le <?php echo $data['date_post_fr']; ?></em>
            </h3>

             <p>
            <?php
            // On affiche le contenu du billet
            echo nl2br(htmlspecialchars($data['post_content']));
            ?>
            <br />
            <!--em><a href="#">Commentaires</a></em-->
            <em><a href="comments.php?post=<?php echo $data['id_post']; ?>">Commentaires</a></em>
            </p>
        </div>

        <?php
        } // Fin de la boucle des billets
        $posts->closeCursor();
        ?>

    </body>
</html>