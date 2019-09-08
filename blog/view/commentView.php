<?php ob_start(); ?>

<h1>Mon super blog !</h1>
<p><a href="index.php">Retour à la liste des billets</a></p>

<h2>Modifier le commentaire</h2>

<?php 
$selectComment=$selectedComment->fetch();
?>

<form action="index.php?action=notifyComment&amp;id=<?= $selectComment['id']?>" method="post">
	<div>
	    <label for="notification">Voulez-vous signaler ce commentaire ?</label><br />
	    <input type="checkbox" id="yes" name="yes" value= Oui >
	    <input type="checkbox" id="no" name="no" value= Non >
	    <input type="submit" />
	</div>
</form>

<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>