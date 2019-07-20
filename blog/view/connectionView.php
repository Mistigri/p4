<?php 

ob_start(); 

?>

<h1>Bienvenue sur mon blog !</h1>

<div class = "connectionForm">

	<form action="index.php?action=login" method="post">
		<input type="text" name="username" placeholder="Nom d'utilisateur">
		<input type="password" name="password" placeholder="Mot de passe">
		<input type="submit" name="connexion" value="Se connecter">
	</form>

	<em><a href="index.php?action=register">S'inscrire</a></em>
</div>

<?php

if (isset($_SESSION['id']) AND isset($_SESSION['username'])) {
	?>
	<p>Bonjour <?=htmlspecialchars($_SESSION['username']);?></p>
    <div class = "logOut">
		<em><a href="index.php?action=logOut">Se déconnecter</a></em>
	</div>
<?php
}

$content = ob_get_clean(); 

?>

<?php require('template.php'); ?>





