<?php
include 'inc/bootstrap.php';
include 'install.php';
App::getAuth();
$page = $_POST['page'];
$user_id = $_SESSION['auth']['user_id'];
$coms = 127;
$sign =  $coms < 0 ? 'plus' : 'minus';
$pageImages = $gallery->get_images($page);
foreach ($pageImages as $img) : ?>
    <div class="gal_img">
        <div class="img_name"><p><?= $img['img_user']; ?></p></div>
        <img src="<?= $img['img_name'];?>" onclick="location.href='index.php?page=image&image= <?= $img['img_id'] ?>'"/>
        <div class="info">
            <div class="comments">127 coms</div>
            <div class="votes <?= $sign ?>">12</div>
        </div>
    </div>
<?php endforeach; ?>