<?php

class PostManager {
    public function getPosts() {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, pseudo, message, DATE_FORMAT(creation_date, \'%d/%m/%Y %Hh%i\') AS date_message FROM minichat ORDER BY date_message DESC LIMIT 0, 5');
        return $req;
    }


    public function getPost($postId) {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, message, DATE_FORMAT(creation_date, \'%d/%m/%Y %Hh%i\') AS date_message FROM minichat WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }

    private function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
        return $db;
    }
}