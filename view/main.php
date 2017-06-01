<?php
if (!defined('index'))
    die('Accès interdit');
?>
<html>
    <script src="script/ajax.js"></script>
    <head>
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <link rel="stylesheet" type="text/css" href="CSS/main.css">
	    <link rel="icon" type="image/png" href="img/logo.png">
	    <title>Camagru</title>
    </head>


    <div class="top_bar">
        <div class="menu">
            <li><a href="index.php">HOME</a></li>
                <div class="title"></div>
            <li><a href="index.php?page=gallery&p=0">GALLERY</a></li>
        </div>
        <a href="index.php?page=logout"><div class="box3 box_menu"></div></a>
    </div>
    <body>
    <?php if(Session::getInstance()->hasFlashes()) : ?>
        <?php foreach(Session::getInstance()->getFlashes() as $type => $message): ?>
            <div class="alert alert-<?= $type; ?>">
                <?= $message; ?>
            </div>
        <?php endforeach; ?>
    <?php endif ; ?>
        <?= $content; ?>
    </body>
<footer>
    <p>Copyright 2017 by jwalle. All Rights Reserved.</p>
</footer>
</html>