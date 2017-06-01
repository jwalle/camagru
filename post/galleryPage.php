<?php
require '../inc/bootstrap.php';
App::getAuth();
$gallery = App::getGallery();
$page = $_POST['page'];
$pages = ceil($gallery->getImagesCount() / 20);
if ($page >= 0 && $page < $pages) {
    $pageImages = $gallery->get_images($page);
    foreach ($pageImages as $img) : ?>
    <?php $sign =  intval($img['votes']) >= 0 ? 'plus' : 'minus'; ?>
    <div class="gal_img">
        <div class="img_name"><p><?= $img['img_user']; ?></p></div>
        <img src="<?= $img['img_name'];?>" onclick="location.href='index.php?page=image&image= <?= $img['img_id'] ?>'"/>
        <div class="info">
            <div class="comments"><?= $img['comments'] ;?> com(s)</div>
            <div class="votes <?= $sign ?>"><?= $img['votes'];?></div>
        </div>
    </div>
<?php endforeach; } ?>
