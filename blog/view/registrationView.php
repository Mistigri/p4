<?php ob_start(); ?>

<h1>Bienvenue sur mon blog !</h1>

<div class = "registrationForm">
	<h4>S'inscrire : </h4>

	<form action="index.php?action=register" method="post">
		<input type="text" name="username" placeholder="Nom d'utilisateur">
		<input type="password" name="password" placeholder="Mot de passe">
		<input type="submit" class="btn btn-info" name="inscription" value="S'enregistrer">
	</form>

	<em><a href="index.php">Se connecter</a></em>
</div>

<?php $content= ob_get_clean(); ?>

<?php require('view/frontend/template.php'); ?>