<?php

namespace ML\Blog\Model;

require_once("model/Manager.php");

class LogManager extends \ML\Blog\Model\Manager {

    public function userExist($username) {
        $db = $this->dbConnect();
        $checkUser = $db->prepare('SELECT * FROM users WHERE username = :username LIMIT 0, 250');
        $checkUser->execute(array('username' =>  $username));
        return $checkUser;
    }

    public function register($username, $password) {
        $db = $this->dbConnect();
        $insertUser = $db->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
        $insertUser->execute(array('username' => $username, 'password' => $password));
        return $insertUser;
    }

    public function login($username, $password) {
        $db = $this->dbConnect();
        $checkUser = $db->prepare('SELECT id, username, password, status FROM users WHERE username = :username LIMIT 0, 250');
        $checkUser->execute(array('username' =>  $username));
        return $checkUser; 
    }
}