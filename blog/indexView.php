<?php $title = 'Mon blog'; ?>

<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch()) {
?>

<div class="news">
    <h3>
        <?= htmlspecialchars($data['post_title']); ?>
        <em>le <?= $data['date_post_fr']; ?></em>
    </h3>

     <p>
    <?= nl2br(htmlspecialchars($data['post_content']));
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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


