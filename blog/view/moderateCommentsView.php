<?php 

ob_start(); 

?>

<?php 

if(isset($_SESSION['id']) && ($_SESSION['status'] == 1)) {
?>

    <em><a href="index.php">Retour à la liste des articles.</a></em>

    <h1>Commentaires signalés :</h1>

    <?php
    while ($data = $comments->fetch()) {
    ?>

    <div class="news">
        <h3>
            <?= htmlspecialchars($data['username']); ?>
            <em>le <?= $data['comment_date']; ?></em>
        </h3>

         <p>
        <?= nl2br($data['comment']);
        ?>
        <br />

        <em><a href="index.php?action=deleteComment&id=<?= $data['id'] ?>">Supprimer le commentaire</a></em>
        <em><a href="index.php?action=ignoreComment&id=<?= $data['id'] ?>">Ignorer le signalement</a></em>
        </p>
    </div>

    <?php
    }
     // Fin de la boucle des billets
    $comments->closeCursor();

    ?>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


