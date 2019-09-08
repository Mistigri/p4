<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska !</h1>
<a class="btn btn-info retourListe" href="index.php">Retour à la liste des billets</a>

<div class="news">
    <h3>
        <?= htmlspecialchars($post['title']); ?>
        <em>le <?= $post['creation_date_fr']; ?>
        <?php if(($post['creation_date_fr']) !== ($post['update_date_fr'])) {
            echo '<br/>Dernière mise à jour : '.($post['update_date_fr']);
        }
        ?></em>
    </h3>

    <?php echo nl2br($post['content']); ?>
</div>

<div class="comments">
    <h2>Commentaires</h2>
    <?php if(isset($_SESSION['id'])) {
        ?>

        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="comment">Commentaire</label><br />
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit" />
            </div>
        </form>

    <?php
    }

    while ($comment = $comments->fetch()) {

    ?>

    <p><strong><?= (htmlspecialchars($comment['commentWriter'])); ?></strong> le <?= $comment['comment_date_fr']; ?> 
    <?php 
    if(isset($_SESSION['id'])) {
        ?>
        (<a href="index.php?action=notifyComment&amp;id=<?=$comment['id']?>">Signaler</a>)</p>
        <?php
    }
    ?>

    <p><?= nl2br(htmlspecialchars($comment['comment'])); ?></p>

    <?php

    } // Fin de la boucle des commentaires

    ?>

</div>

<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>
