<?php
require '../inc/bootstrap.php';
App::getAuth();
$gallery = App::getGallery();
$pages = ceil($gallery->getImagesCount() / 20);
for($x = 1; $x <= $pages; $x++) : ?>
    <p onclick="location.href='index.php?page=gallery&p=<?= ($x - 1) ?>'"><?= $x ?></p>&nbsp
<?php endfor; ?>