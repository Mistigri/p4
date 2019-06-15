<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?= $title ?></title>
        <link href="public/css/style.css" rel="stylesheet" /> 
		<!--script src="https://cloud.tinymce.com/5/tinymce.min.js?apiKey=AIzaSyBvatbqIibckLDXkZknTifQN0ZEmov8j_s"></script-->
		<script src="https://cdn.tiny.cloud/1/cfrzdwr2883ozk22peorltuqrkcyt8jxiqelelhtmz885mrw/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> 
	    <script>tinymce.init({ selector: '#newPost' });</script>
    </head>

    <body>
        <?= $content ?>
    </body>
</html>