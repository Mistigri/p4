<?php

require('controller.php');

if (isset($_GET['action'])) {
    if ($_GET['action'] == 'listPosts') {
        listPosts();
    }
    elseif ($_GET['action'] == 'post') {
        if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {
            post();
        }
        else {
            echo 'Erreur : aucun identifiant de billet envoyé';
        }
    }
    elseif ($_GET['action'] == 'addComment') {
	    if (isset($_GET['id_post']) && $_GET['id_post'] > 0) {
	        if (!empty($_POST['author']) && !empty($_POST['comment_content'])) {
	            addComment($_GET['id_post'], $_POST['author'], $_POST['comment_content']);
	        }
	        else {
	            echo 'Erreur : tous les champs ne sont pas remplis !';
	        }
	    }
	    else {
	        echo 'Erreur : aucun identifiant de billet envoyé';
	    }
    }
}

else {
    listPosts();
}
