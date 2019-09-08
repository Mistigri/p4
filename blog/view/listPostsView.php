<?php ob_start(); ?>

<h1>Billet simple pour l'<strong>Alaska</strong> !</h1>
<span class="badge badge-info listeBillets">Derniers billets du <strong>blog</strong> :</span>

<?php

//Ajout de la possibilité d'ajouter un article pour l'administrateur du site
if(isset($_SESSION['status']) AND ($_SESSION['status']) == 1) {
    ?>
    <div class="optionsAuteur">
        <em><a href="index.php?action=addPost">Ajouter un article</a></em><br/>
        <em><a href="index.php?action=moderateComments">Modérer les commentaires</a></em>
    </div>
    <?php
}

while ($data = $posts->fetch()) {
?>

<div class="news">
    <h3>
        <?= htmlspecialchars($data['title']); ?>
        <em>le <?= $data['creation_date_fr']; ?>
        <?php if(($data['creation_date_fr']) !== ($data['update_date_fr'])) {
        echo '<br/>Dernière mise à jour : '.($data['update_date_fr']);
        }
        ?></em>
    </h3>

    <?= nl2br($data['content']);
    ?>
    <div class="row justify-content-center groupeBoutons" >
        <a class="btn btn-secondary commentaires" href="index.php?action=post&id=<?= $data['id'] ?>" role="button">Commentaires</a>
        <?php
        if(isset($_SESSION['status']) AND ($_SESSION['status']) == 1) {
        ?>
            <a class="btn btn-secondary modification" href="index.php?action=updatePost&id=<?= $data['id'] ?>" role="button">Modifier un article</a>
            <a class="btn btn-secondary suppression" href="index.php?action=deletePost&id=<?= $data['id'] ?>" role="button">Supprimer un article</a>
        <?php
        }
        ?>
    </div>
</div>


<?php
} // Fin de la boucle des billets
$posts->closeCursor();

?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


