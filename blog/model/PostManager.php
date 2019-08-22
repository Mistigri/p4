<?php

//session_start();

namespace ML\Blog\Model;

require_once("model/Manager.php");

class PostManager extends \ML\Blog\Model\Manager {
    //récupérer les articles
    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %Hh%i\') AS update_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 50'); 

        return $req; 
    }

    //récupérer un article à partir de son id
    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(update_date, \'%d/%m/%Y à %Hh%i\') AS update_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    //mettre à jour un article
    public function updatePost($postId, $newTitle, $newPost) {
        $db = $this -> dbConnect();
        $oldPost = $this->getPost($postId);
        $postUpdated = $db -> prepare ('UPDATE posts SET title = ?, content = ?, update_date=NOW() WHERE id=?');
        $affectedPost = $postUpdated->execute(array($newTitle, $newPost, $postId));

        return $affectedPost;
    }

    //supprimer un article
    public function deletePost($postId) {
        $db = $this -> dbConnect();
        $postDeleted = $db -> prepare ('DELETE FROM posts WHERE id=?');
        $postDeleted->execute(array($postId));

        return $postDeleted;
    }
    //supprimer les commentaires relatifs à un post supprimé
    public function deleteComments($postId) {
        $db = $this -> dbConnect();
        $commentsDeleted = $db -> prepare ('DELETE FROM comments WHERE post_id=?');
        $commentsDeleted->execute(array($postId));

        return $commentsDeleted;
    }

    //ajouter un nouvel article
    public function addNewPost($postTitle,$postContent) {
        $db = $this->dbConnect();
        $posts = $db->prepare('INSERT INTO posts(title, content, creation_date, update_date) VALUES(?, ?, NOW(), NOW())');
        $affectedLines = $posts->execute(array($postTitle, $postContent));

        return $affectedLines;
    }
}

