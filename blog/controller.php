<?php

require('model.php');

function listPosts() {
    $posts = getPosts();

    require('listPostsView.php');
}


function post() {
    $post = getPost($_GET['id_post']);
    $comments = getComments($_GET['id_post']);

    require('postView.php');
}