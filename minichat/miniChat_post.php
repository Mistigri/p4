<?php
session_start();


if ((isset($_POST['pseudo'])) && (isset($_POST['message']))) {
	$_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
	// Connexion à la base de données
	try {
	    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
	}
	catch(Exception $e) {
		echo 'catch';
	        die('Erreur : '.$e->getMessage());
	}

	// Insertion du message à l'aide d'une requête préparée
	$req = $bdd->prepare('INSERT INTO minichat (pseudo, message, date_message) VALUES(?, ?, NOW())');
	$req->execute(array($_POST['pseudo'], $_POST['message']));

	// Redirection du visiteur vers la page du minichat
	header('Location: miniChat.php');	
}

else {
    echo '<p>Pseudo ou message incorrect</p>';
}
?>