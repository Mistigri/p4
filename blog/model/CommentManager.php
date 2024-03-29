<?php

namespace ML\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends \ML\Blog\Model\Manager {
    //récupérer les commentaires d'un article
    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT comments.id, users.username AS commentWriter, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%i\') AS comment_date_fr FROM comments INNER JOIN users ON comments.id_author = users.id WHERE comments.post_id = ? ORDER BY comments.comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    //poster un commentaire
    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, id_author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

    //nouvelle partie modif commentaires
    public function selectComment($commentId) {
        $db = $this->dbConnect();
        $selectedComment = $db->prepare('SELECT id, notification FROM comments WHERE id = ?');
        $selectedComment->execute(array($commentId));
 
        return $selectedComment;
    }

    //partie de modération des commentaires
    //signaler un commentaire
    public function notifyComment($commentId) {
        $db = $this->dbConnect();
        $notifiedComment = $db->prepare('UPDATE comments SET notification = notification +1 WHERE id=?');
        $affectedComment = $notifiedComment->execute(array($commentId));
 
        return $affectedComment;
    }
    //récupérer les commentaires signalés
    public function getCommentsToModerate() {
        $db = $this ->dbConnect();
        $selectedComments = $db ->query('SELECT comments.id, comments.post_id, users.username, comments.comment, comments.comment_date FROM comments INNER JOIN users ON comments.id_author = users.id WHERE comments.notification>0');

        return $selectedComments;
    }
    //supprimer un commentaire signalé
    public function deleteComment($commentId) {
        $db = $this -> dbConnect();
        $commentDeleted = $db -> prepare ('DELETE FROM comments WHERE id=?');
        $commentDeleted->execute(array($commentId));

        return $commentDeleted;
    }
    //confirmer un commentaire signalé
    public function ignoreComment($commentId) {
        $db = $this -> dbConnect();
        $commentIgnored = $db -> prepare ('UPDATE comments SET notification = 0 WHERE id=?');
        $commentIgnored->execute(array($commentId));

        return $commentIgnored;
    }
}