<?php 

$title = 'Mon blog';

ob_start(); 

if(isset ($_SESSION['username'])) {
    echo 'Bonjour '.$_SESSION['username']. '.';
    ?>
    <div class = "logOut">
        <em><a href="index.php?action=logOut">Se déconnecter</a></em>
    </div>

<?php
}
else {
    include("connectionView.php");
}

?>

<h1>Mon super blog !</h1>
<p>Derniers billets du blog :</p>


<?php
while ($data = $posts->fetch()) {
?>

<div class="news">
    <h3>
        <?= htmlspecialchars($data['title']); ?>
        <em>le <?= $data['creation_date_fr']; ?></em>
    </h3>

     <p>
    <?= nl2br(htmlspecialchars($data['content']));
    ?>
    <br />

    <em><a href="index.php?action=post&id=<?= $data['id'] ?>">Commentaires</a></em>
    </p>
</div>

<?php
} // Fin de la boucle des billets
$posts->closeCursor();

//Ajout de la possibilité d'ajouter un article pour l'administrateur du site
if(isset($_SESSION['status']) AND ($_SESSION['status']) == 1) {
    ?>
    <em><a href="index.php?action=addPost">Ajouter un article</a></em><br/>

    <em><a href="index.php?action=moderateComments">Modérer les commentaires</a></em>
    <?php
}

?>

<?php $content = ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>


