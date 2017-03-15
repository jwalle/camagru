<?php
$user_id = $user->get_id($_SESSION['username']);
$coms = 127;
$signs =  $coms < 0 ? 'plus' : 'minus';
$images = $gallery->get_images($_GET['p']);
//var_dump($images);
?>
<div class="wrapper">
    <h2>Gallery :</h2>
    <div class="gallery">
    <?php foreach ($images as $img) : ?>
        <div class="gal_img border">
            <div class="img_name"><p><?= $img['img_user']; ?></p></div>
            <img src="<?= $img['img_name'];?>" onclick="location.href='index.php?page=image&image= <?= $img['img_id'] ?>'"/>
            <div class="info">
                <div class="comments">127 coms</div>
                <div class="votes <?= $sign ?>">12</div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</div>