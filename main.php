<html>
    <head>
	    <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="stylesheet" type="text/css" href="new.css">
	    <link rel="icon" type="image/png" href="img/logo.png">
	    <title>Camagru</title>
    </head>


    <div class="top_bar">
        <div class="menu">
            <a href="index.php"><div class="box1 box_menu"></div></a>
            <div class="box2 box_menu"></div>
        </div>
        <a href="index.php?page=logout"><div class="box3 box_menu"></div></a>
    </div>
    <body>
        <?= $content; ?>
    </body>
</html>
