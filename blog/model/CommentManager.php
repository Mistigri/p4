<?php

//session_start();

namespace ML\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends \ML\Blog\Model\Manager {

    public function getComments($postId) {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT comments.id, users.name, comments.comment, DATE_FORMAT(comments.comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments INNER JOIN users ON comments.id_author = users.id WHERE comments.post_id = ? ORDER BY comments.comment_date DESC');
        $comments->execute(array($postId));

        return $comments;

    }

    public function postComment($postId, $author, $comment) {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, id_author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }

/*nouvelle partie modif commentaires
    public function selectComment($commentId) {
        $db = $this->dbConnect();
        $selectedComment = $db->prepare('SELECT id, post_id, id_author, comment FROM comments WHERE id = ?');
        $selectedComment->execute(array($commentId));
 
        return $selectedComment;
    }*/

    //partie de signalement d'un commentaire inapproprié
    public function notifyComment($commentId) {
        $db = $this->dbConnect();
        $oldComment = $this->selectComment($commentId);
        $notifiedComment = $db->prepare('UPDATE comments SET notification = ? WHERE id=?');
        $affectedComment = $notifiedComment->execute(array($notification, $commentId));
 
        return $notifiedComment;
    }

    /*fonction modification de commentaire
    public function modifyComment($commentId, $newAuthor, $newComment) {
        $db = $this->dbConnect();
        $oldComment = $this->selectComment($commentId);
        $modifiedComment = $db->prepare('UPDATE comments SET comment = ?, id_author = ? WHERE id=?');
        $affectedComment = $modifiedComment->execute(array($newComment, $newAuthor,$commentId));
 
        return $affectedComment;
    }*/
}