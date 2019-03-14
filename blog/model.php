<?php

function getPosts() {
    $db = dbConnect();
    // On récupère les 5 derniers billets
    $req = $bdd->query('SELECT id_post, post_title, post_content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');  

    return $req;  
}

function getPost($postId) {
    $db = dbConnect();
    $req = $db->prepare('SELECT id_post, post_title, post_content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr FROM posts WHERE id_post = ?');
    $req->execute(array($postId));
    $post = $req->fetch();

    return $post;
}

function getComments($postId) {
    $db = dbConnect();
    $comments = $db->prepare('SELECT id_comment, author, comment_content, DATE_FORMAT(date_comment, \'%d/%m/%Y à %Hh%imin%ss\') AS date_comment_fr FROM comments WHERE id_post = ? ORDER BY date_comment DESC');
    $comments->execute(array($postId));

    return $comments;
}

function dbConnect() {
    try {
        $db = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }

    catch(Exception $e) {
        die('Erreur : '.$e->getMessage());
    }    
}


