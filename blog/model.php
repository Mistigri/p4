<?php

function getPosts() {
    // Connexion à la base de données
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
    }

    catch(Exception $e) {
            die('Erreur : '.$e->getMessage());
    }

    // On récupère les 5 derniers billets
    $req = $bdd->query('SELECT id_post, post_title, post_content, DATE_FORMAT(date_post, \'%d/%m/%Y à %Hh%imin%ss\') AS date_post_fr FROM posts ORDER BY date_post DESC LIMIT 0, 5');  

    return $req;  
}

?>


