<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LogManager.php');


//connexion
function login($username, $password) {
	$logUser = new \ML\Blog\Model\LogManager();
	$checkUser = $logUser->userExist($username);
	if ($checkUser) {
		$checkUser = $logUser->login($username, $password);
		$checkedUser = $checkUser->fetch();
		$isPasswordCorrect = password_verify($password, $checkedUser['password']);
		if ($isPasswordCorrect) {
	        session_start();
	        $_SESSION['id'] = $checkedUser['id'];
	        $_SESSION['username'] = $username;
	        $_SESSION['status'] = $checkedUser['status'];

	        var_dump($checkedUser['status']);
	        echo 'Vous êtes connecté !';
	        header('Location: index.php');
		}
	    else {
	        echo 'Erreur : l\'identifiant et/ou le mot de passe ne correspondent pas.';
	        //header('Location:index.php?action=listPosts');
	    }
	}
	else {
		header('Location: index.php?action=register&username=' . $username);
	}
}
//recherche d'un utilisateur par son pseudo
function selectUser($username) {
	$logManager = new \ML\Blog\Model\LogManager();
	$selectedUser = $logManager->userExist($username);
	if ($selectedUser === true) {
		throw new Exception('Cet identifiant existe déjà !');
	}
	else {
	    header('Location: index.php?action=register&username=' . $username);
	}
	require('view/frontend/connectionView.php');
}
//enregistrement si inconnu
function register($username, $password) {
	$logManager = new \ML\Blog\Model\LogManager();
	$selectedUser = $logManager->userExist($username);
	if ($selectedUser === true) {
		var_dump("utilisateur existe déjà" );
		throw new Exception('Cet identifiant existe déjà !');
	}
	else {
		$pass_hache = password_hash($password, PASSWORD_DEFAULT);
	   	$insertUser = $logManager->register($username,$pass_hache); 
	}
	//header('Location: index.php');
}


//accès à la liste des posts
function listPosts() {
    $postManager = new \ML\Blog\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet
    require('view/frontend/listPostsView.php');
}


//accès à un post et à ses commentaires
function post() {
    $postManager = new \ML\Blog\Model\PostManager();
    $commentManager = new \ML\Blog\Model\CommentManager();
    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);
    require('view/frontend/postView.php');
}

function addPost() {
	require('view/frontend/addPostView.php');
}


function addPost2($post) {
	$postManager = new \ML\Blog\Model\PostManager();
	$affectedLines = $postManager->addPost($post);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le post !');
    }
    else {
        require('view/frontend/listPostView.php');
    }
}

function addComment($postId, $author, $comment) {
    $commentManager = new \ML\Blog\Model\CommentManager();
    $author = $_SESSION['id'];
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function notifyComment($commentId/*, $postId*/) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->notifyComment($commentId/*, $postId*/);
	if ($selectedComment === false) {
	    throw new Exception('Impossible de signaler le commentaire !');
	}
	else {
		//$backToPost = $commentManager -> returnToPost($commentId);

header('Location: index.php');
	}
	
}

function selectComment($commentId) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->selectComment($commentId);
	require('view/frontend/commentView.php');
}
/*ajout modif commentaire
function modifyComment($commentId, $postId, $newAuthor, $newComment) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->modifyComment($commentId, $newAuthor, $newComment);
	if ($selectedComment === false) {
	    throw new Exception('Impossible d\'ajouter le commentaire !');
	}
	else {
	    header('Location: index.php?action=post&id=' . $postId);
	}
	require('view/frontend/commentView.php');
}*/

