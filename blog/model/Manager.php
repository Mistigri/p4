<?php



namespace ML\Blog\Model;

//session_start();

class Manager {
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
        return $db;
    }
}