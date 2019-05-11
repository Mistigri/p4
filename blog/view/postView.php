<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog avec commentaires</title>

    </head>

    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <div class="news">
            <h3>
                <?php echo htmlspecialchars($post['post_title']); ?>
                <em>le <?php echo $post['date_post_fr']; ?></em>
            </h3>

            <p>
            <?php
            echo nl2br(htmlspecialchars($post['post_content']));
            ?>
            </p>
        </div>

        <h2>Commentaires</h2>

        <form action="index.php?action=addComment&amp;id=<?= $post['id_post'] ?>" method="post">
        <div>
            <label for="author">Auteur</label><br />
            <input type="text" id="author" name="author" />
        </div>
        <div>
            <label for="comment">Commentaire</label><br />
            <textarea id="comment_content" name="comment_content"></textarea>
        </div>
        <div>
            <input type="submit" />
        </div>
        </form>

        <?php

        while ($comment = $comments->fetch()) {

        ?>

        <p><strong><?= htmlspecialchars($comment['author']); ?></strong> le <?= $comment['date_comment_fr']; ?></p>

        <p><?= nl2br(htmlspecialchars($comment['comment_content'])); ?></p>

        <?php

        } // Fin de la boucle des commentaires

        $req->closeCursor();

        ?>

</body>
</html>