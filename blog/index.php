<?php

session_start();

require('controller/frontend.php');

try {
	if (isset($_GET['action'])) {

		//connexion ou enregistrement et déconnexion
		//connexion
		if ($_GET['action'] == 'login') {
	        if (!empty($_POST['username']) && !empty($_POST['password'])) {
	            login($_POST['username'], ($_POST['password']));
	        }
	        else {
	            require("view/frontend/headerView.php");
	        }
	    }	
	    //enregistrement
	    if ($_GET['action'] == 'register') {
	        if (!empty($_POST['username']) && !empty($_POST['password'])) {
	            register($_POST['username'], ($_POST['password']));
	        }
	        else {
	            require("view/frontend/registrationView.php");
	        }
	    }
	    //déconnexion
	    if ($_GET['action'] == 'logOut') {
	    	$_SESSION = array();
			session_destroy();
			listPosts();
	    }


	    //pour un utilisateur non connecté : 
	    //afficher la liste des posts : affichage par défaut
	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }
	    //accéder à un post et à ses commentaires (sans possibilité d'en ajouter)
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
	            post();
	        }
	        else {
	        	header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant de billet envoyé.');
	        }
	    }


    	//pour un utilisateur connecté : ajout ou notification d'un commentaire et retour à la liste des posts
    	//ajouter un commentaire
	    elseif ($_GET['action'] == 'addComment') {
		    if (isset($_GET['id']) && $_GET['id'] > 0) {
		        if (!empty($_POST['comment'])) {
		            addComment($_GET['id'], $_SESSION['id'], $_POST['comment']);
		        }
		        else {
		        	header('Location:index.php?action=showError&errorMessage=Erreur : tous les champs ne sont pas remplis.');
		        }
		    }
		    else {
		    	header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant de billet envoyé.');
		    }
	    }
	    //signaler des commentaires
	    elseif ($_GET['action'] == 'notifyComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		notifyComment($_GET['id']);
        	}
        	else {
        		header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant de commentaire envoyé.');
        	}	
	    }


        //pour l'administrateur : ajout, modification et suppression d'un post et modération des commentaires
	    //accéder à la page pour ajouter un post
	    elseif ($_GET['action'] == 'addPost') {
	            addPost();
        }
    	//accéder au formulaire pour ajouter un post
	    elseif ($_GET['action'] == 'formPost') {
	        if (!empty($_POST['titlePost']) && !empty($_POST['newPost'])) {
	            formPost($_POST['titlePost'], $_POST['newPost']);
	        }
	        else {
	        	header('Location:index.php?action=showError&errorMessage=Erreur : tous les champs ne sont pas remplis.');
	        }
	    }
	    //accéder à la page pour modifier un post
	    elseif ($_GET['action'] == 'updatePost') {
	            updatePost($_GET['id']);
        }
    	//accéder au formulaire pour modifier un post
	    elseif ($_GET['action'] == 'updateFormPost') {
	        if (!empty($_POST['newTitle']) && !empty($_POST['newPost'])) {
	            updateFormPost($_GET['id'], $_POST['newTitle'], $_POST['newPost']);
	        }
	        else {
	        	header('Location:index.php?action=showError&errorMessage=Erreur : tous les champs ne sont pas remplis.');
	        }
	    }
        //supprimer un article
	    elseif ($_GET['action'] == 'deletePost') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		deletePost($_GET['id']);
        	}
        	else {	
	        	header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant d\'article envoyé.');
        	}	
	    }


		//accèder à la page des commentaires signalés
	    elseif ($_GET['action'] == 'moderateComments') {
            moderateComments();
        }
        //supprimer un commentaire signalé
	    elseif ($_GET['action'] == 'deleteComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		deleteComment($_GET['id']);
        	}
        	else {
        		header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant de commentaire envoyé.');
        	}	
	    }
	    elseif ($_GET['action'] == 'ignoreComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		ignoreComment($_GET['id']);
        	}
        	else {
        		header('Location:index.php?action=showError&errorMessage=Erreur : aucun identifiant de commentaire envoyé.');
        	}	
	    }


	   	//afficher le message d'erreur
	    elseif ($_GET['action'] == 'showError') {
	    	showError($_GET['errorMessage']);
	    }
	}
	//affichage par défaut : liste des articles
	else {
	    listPosts();
	}	
}

catch(Exception $e) { 
    echo 'Erreur : ' . $e->getMessage();
}



