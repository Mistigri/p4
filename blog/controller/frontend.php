<?php

// Chargement des classes
require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/LogManager.php');


//connexion d'un utilisateur
function login($username, $password) {
	$logUser = new \ML\Blog\Model\LogManager();
	$checkUser = $logUser->userExist($username);
	if ($checkUser->rowCount() != 0) {
		$checkUser = $logUser->login($username, $password);
		$checkedUser = $checkUser->fetch();
		$isPasswordCorrect = password_verify($password, $checkedUser['password']);
		if ($isPasswordCorrect) {
	        session_start();
	        $_SESSION['id'] = $checkedUser['id'];
	        $_SESSION['username'] = $username;
	        $_SESSION['status'] = $checkedUser['status'];
	        header('Location: index.php');
		}
	    else {
	    	header('Location:index.php?action=showError&errorMessage=Erreur : l\'identifiant et/ou le mot de passe ne correspondent pas.');
	    }
	}
	else {
		header('Location:index.php?action=showError&errorMessage=Erreur : l\'identifiant et/ou le mot de passe ne correspondent pas.');
	}
}

//enregistrement si inconnu
function register($username, $password) {
	$logManager = new \ML\Blog\Model\LogManager();
	$checkUser = $logManager->userExist($username);

	if ($checkUser ->rowCount() != 0) {
		header('Location:index.php?action=showError&errorMessage=Erreur : cet identifiant existe déjà.');
	}
	else {
		$pass_hache = password_hash($password, PASSWORD_DEFAULT);
	   	$insertUser = $logManager->register($username,$pass_hache); 
	   	header('Location: index.php');
	}
}


//utilisateur non connecté
//accès à la liste des posts
function listPosts() {
    $postManager = new \ML\Blog\Model\PostManager(); 
    $posts = $postManager->getPosts(); 
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


//utilisateur connecté
//possibilité d'ajouter un commentaire
function addComment($postId, $author, $comment) {
    $commentManager = new \ML\Blog\Model\CommentManager();
    $author = $_SESSION['id'];
    $affectedLines = $commentManager->postComment($postId, $author, $comment);
    if ($affectedLines === false) {
    	header('Location:index.php?action=showError&errorMessage=Erreur : impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
//possibilité de signaler un commentaire
function notifyComment($commentId) {
	$commentManager = new \ML\Blog\Model\CommentManager();
	$selectedComment = $commentManager->notifyComment($commentId);
	if ($selectedComment === false) {
		header('Location:index.php?action=showError&errorMessage=Erreur : impossible de signaler le commentaire !');
	}
	else {
		header('Location: index.php');
	}	
}


//fonctionnalités de l'auteur
//accéder à la page d'ajout d'article
function addPost() {
	require('view/frontend/addPostView.php');
}
//poster le nouvel article
function formPost($postTitle, $postContent) {
	$postManager = new \ML\Blog\Model\PostManager();
	$affectedLines = $postManager->addNewPost($postTitle, $postContent);
    if ($affectedLines === false) {
    	header('Location:index.php?action=showError&errorMessage=Erreur : impossible d\'ajouter l\'article !');
    }
    else {
        header('Location:index.php?action=listPosts');
    }
}
//accéder à la page de mise à jour d'un article
function updatePost($postId) {
	$postManager = new \ML\Blog\Model\PostManager();
	$selectedPost = $postManager->getPost($postId);

	require('view/frontend/updatePostView.php');
}
//poster l'article mis à jour
function updateFormPost($postId, $newTitle, $newPost) {
	$postManager = new \ML\Blog\Model\PostManager();
	$selectedPost = $postManager->updatePost($postId, $newTitle, $newPost);
	if ($selectedPost === false) {
		header('Location:index.php?action=showError&errorMessage=Erreur : impossible de modifier l\'article !');
	}
	else {
	    header('Location:index.php?action=listPosts');
	}
}
//supprimer un article
function deletePost($postId) {
	$postManager = new \ML\Blog\Model\postManager();
    $getPostToDelete = $postManager->deletePost($_GET['id']);
    header('Location:index.php?action=listPosts');
}


//accéder à la page de modération des commentaires
function moderateComments() {
	$commentManager = new \ML\Blog\Model\CommentManager();
    $comments = $commentManager->getCommentsToModerate();
	require('view/frontend/moderateCommentsView.php');
}
//supprimer un commentaire notifié
function deleteComment($commentId) {
	$commentManager = new \ML\Blog\Model\CommentManager();
    $getCommentToDelete = $commentManager->deleteComment($_GET['id']);
    header('Location:index.php?action=moderateComments');
}
//confirmer un commentaire signalé
function ignoreComment($commentId) {
	$commentManager = new \ML\Blog\Model\CommentManager();
    $ignoredComment = $commentManager->ignoreComment($_GET['id']);
    header('Location:index.php?action=moderateComments');
}


//afficher un message d'erreur
function showError($errorMessage) {
	require('view/frontend/errorView.php');
}

