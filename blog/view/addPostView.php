<?php 

ob_start(); 

?>

<?php 

if(isset($_SESSION['id']) && ($_SESSION['status'] == 1)) {
?>    
    <p><a href="index.php">Retour à la liste des billets</a></p>

    <div class="Ajouter un post :">
        <form action = "index.php?action=formPost" method="POST">
            <label for ="titre">Titre : </label><input type = "text" id="titlePost" name="titlePost"><br/>
            <label for = "texte">Texte : </label><textarea id ="newPost" name= "newPost"></textarea><br/>
            <input type ="submit" value = "Enregistrer">
        </form>    
    </div>

<?php
}
?>

<?php

$content = ob_get_clean(); 

?>
 
<?php require('template.php'); ?>