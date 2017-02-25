<html>
    <head>
	    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="new.css">
	    <link rel="icon" type="image/png" href="img/logo.png">
	    <title>Camagru</title>
    </head>


    <div class="top_bar">
        <div class="menu">
            <div class="title"></div>
            <ul class="nav">
                <li><a href="#">HOME</a></li>
                <li><a href="#">GALLERY</a></li>
            </ul>
<!--            <div class="left_block"><a id="home_link" href="index.php">HOME</a></div>-->
<!--            <div class="right_block"><a id="gal_link" href="index.php">GALLERY</a></div>-->
        </div>
        <a href="index.php?page=logout"><div class="box3 box_menu"></div></a>
    </div>
    <body>
        <?= $content; ?>
    </body>
</html>
