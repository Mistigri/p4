<h1>Bienvenue sur mon blog !</h1>

<div class = "connectionForm">
	<h4>Se connecter : </h4>

	<form action="index.php?action=login" method="post">
		<input type="text" name="username" placeholder="Nom d'utilisateur">
		<input type="password" name="password" placeholder="Mot de passe">
		<input type="submit" name="connexion" value="Connexion">
	</form>

	<em><a href="index.php?action=register ?>">S'inscrire</a></em>
</div>

<div class = "registrationForm">
	<h4>S'inscrire : </h4>

	<form action="index.php?action=register" method="post">
		<input type="text" name="username" placeholder="Nom d'utilisateur">
		<input type="password" name="password" placeholder="Mot de passe">
		<input type="submit" name="inscription" value="Connexion">
	</form>

	<em><a href="index.php?action=login ?>">Se connecter</a></em>
</div>

