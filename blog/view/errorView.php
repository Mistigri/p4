<?php ob_start(); ?>

<h1>Billet simple pour l'Alaska !</h1>
<p><a class="retourListe" href="index.php">Retour à la liste des billets</a></p>

<div class="news">
    <h3>
        <?= htmlspecialchars($_GET['errorMessage']); ?>
    </h3>
</div>

</div>

<?php $content = ob_get_clean(); ?>
 
<?php require('template.php'); ?>
