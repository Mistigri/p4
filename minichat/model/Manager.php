<?php

session_start();

class Manager {
    protected function dbConnect() {
        $db = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
        return $db;
    }
}