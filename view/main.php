<html>
    <script src="script/ajax.js"></script>
    <head>
	    <link rel="stylesheet" type="text/css" href="CSS/style.css">
        <link rel="stylesheet" type="text/css" href="CSS/new.css">
	    <link rel="icon" type="image/png" href="../img/logo.png">
	    <title>Camagru</title>
    </head>


    <div class="top_bar">
        <div class="menu">
            <div class="title"></div>
            <ul class="nav">
                <li><a href="index.php">HOME</a></li>
                <li><a href="index.php?page=gallery&p=0">GALLERY</a></li>
            </ul>
<!--            <div class="left_block"><a id="home_link" href="index.php">HOME</a></div>-->
<!--            <div class="right_block"><a id="gal_link" href="index.php">GALLERY</a></div>-->
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