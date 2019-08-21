<?php
if(isset ($_SESSION['username'])) {
    ?>
    <div class="welcomeUser">
        Bonjour <?= htmlspecialchars($_SESSION['username']); ?>.
        <div class = "logOut">
            <em><a href="index.php?action=logOut">Se déconnecter</a></em>
        </div>
    </div>
<?php
}
else {
    //require("connectionView.php");
    ?>	
    <div class = "connectionForm row justify-content-end">
		<form action="index.php?action=login" method="post">
			<input type="text" name="username" placeholder="Nom d'utilisateur">
			<input type="password" name="password" placeholder="Mot de passe">
			<button type="submit" class="btn btn-info">Se connecter</button>
		</form>
		<span class="sinscrire"><em><a href="index.php?action=register">S'inscrire</a></em></span>
	</div>
<?php
}
