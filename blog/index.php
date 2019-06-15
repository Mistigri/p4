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
	            require("view/frontend/connectionView.php");
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


	    //pour un utilisateur non connecté : accès à un post et à ses commentaires (sans possibilité d'en ajouter)
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
	            post();
	        }
	        else {
	            echo 'Erreur : aucun identifiant de billet envoyé';
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
		            echo 'Erreur : tous les champs ne sont pas remplis !';
		        }
		    }
		    else {
		        echo 'Erreur : aucun identifiant de billet envoyé';
		    }
	    }
	    //signaler des commentaires
	    elseif ($_GET['action'] == 'notifyComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		notifyComment($_GET['id']/*, $_GET['id_post']*/);
        	}
        	else {
        		echo 'Erreur : aucun identifiant de commentaire envoyé';
        	}	
	    }
	    //retourner à la liste des posts
	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }


        //pour l'administrateur : ajout, modification et suppression d'un post et retour à la liste des posts
	    //ajout de la possibilité d'ajouter un post
	    elseif ($_GET['action'] == 'addPost') {
	            addPost();
        }


		/*partie modifier un post
	    elseif ($_GET['action'] == 'modifyPost') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		selectPost($_GET['id']);
        	}
        	else {
        		echo 'Erreur : aucun identifiant de post envoyé';
        	}	
	    }
		//supprimer un post
	    elseif ($_GET['action'] == 'deletePost') {
            	deletePost();
	    }


		partie modif commentaire
	    elseif ($_GET['action'] == 'modifyComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
	    		selectComment($_GET['id']);
        	}
        	else {
        		echo 'Erreur : aucun identifiant de commentaire envoyé';
        	}	
	    }

	    elseif ($_GET['action'] == 'updateComment') {
	    	if (isset($_GET['id']) && $_GET['id'] > 0) {
				if (!empty($_POST['newAuthor']) && !empty($_POST['newComment'])) {
	            	modifyComment($_GET['id'], $_GET['postid'], $_POST['newAuthor'], $_POST['newComment']);
	        	}
	        	else {
	            	echo 'Erreur : tous les champs ne sont pas remplis !';
	        	}
	    	}
	    }*/
	}

	else {
	    listPosts();
	}	
}

catch(Exception $e) { 

    echo 'Erreur : ' . $e->getMessage();

}



