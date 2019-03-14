<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog avec commentaires</title>

    </head>

    <body>
        <h1>Mon super blog !</h1>
        <p><a href="index.php">Retour à la liste des billets</a></p>

<?php
// Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
}

// Récupération du billet
$req = $bdd->prepare('SELECT id_post, post_title, post_content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr FROM posts WHERE id_post = ?');
$req->execute(array($_GET['post']));
$datas = $req->fetch();
?>

<div class="news">
    <h3>
        <?php echo htmlspecialchars($datas['post_title']); ?>
        <em>le <?php echo $datas['date_post_fr']; ?></em>
    </h3>

    <p>
    <?php
    echo nl2br(htmlspecialchars($datas['post_content']));
    ?>
    </p>
</div>



<h2>Commentaires</h2>

<?php

$req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

// Récupération des commentaires
$req = $bdd->prepare('SELECT author, comment_content, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_post = ? ORDER BY date_comment');

$req->execute(array($_GET['post']));

while ($datas = $req->fetch()) {
?>

<p><strong><?php echo htmlspecialchars($datas['author']); ?></strong> le <?php echo $datas['date_comment_fr']; ?></p>

<p><?php echo nl2br(htmlspecialchars($datas['comment_content'])); ?></p>

<?php

} // Fin de la boucle des commentaires

$req->closeCursor();

?>

</body>
</html>