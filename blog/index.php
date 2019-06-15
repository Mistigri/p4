<?php

session_start();

require('controller/frontend.php');

try {
	if (isset($_GET['action'])) {

		if ($_GET['action'] == 'login') {
	        if (!empty($_POST['username']) && !empty($_POST['password'])) {
	            login($_POST['username'], ($_POST['password']));
	        }
	        else {
	            require("view/frontend/connectionView.php");
	        }
	    }	

	    if ($_GET['action'] == 'register') {
	        if (!empty($_POST['username']) && !empty($_POST['password'])) {
	            register($_POST['username'], ($_POST['password']));
	        }
	        else {
	            require("view/frontend/registrationView.php");
	        }
	    }

	    if ($_GET['action'] == 'logOut') {
	    	$_SESSION = array();
			session_destroy();
			require("view/frontend/index.php");
	    }

	    if ($_GET['action'] == 'listPosts') {
	        listPosts();
	    }
	    elseif ($_GET['action'] == 'post') {
	        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
	            post();
	        }
	        else {
	            echo 'Erreur : aucun identifiant de billet envoyé';
	        }
	    }
	    elseif ($_GET['action'] == 'addComment') {
		    if (isset($_GET['id']) && $_GET['id'] > 0) {
		        if (!empty($_POST['author']) && !empty($_POST['comment'])) {
		            addComment($_GET['id'], $_POST['author'], $_POST['comment']);
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
	    		notifyComment($_GET['id']);
        	}
        	else {
        		echo 'Erreur : aucun identifiant de commentaire envoyé';
        	}	
	    }

		/*partie modif commentaire
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



