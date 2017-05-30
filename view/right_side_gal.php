<?php
if (!$_POST['data'])
    die('Accès interdit');
require '../inc/bootstrap.php';
include_once '../config/database.php';
App::getAuth();
App::getDatabase();
$gallery = App::getGallery();
$mini_gal = $gallery->last_three();
$page = "' onclick=\"location.href='index.php?page=image&image="; ?>
<div class="mini_gal_upper"><p>- Gallerie -</p></div>
<div class="mini_gal">
    <?php foreach ($mini_gal as $row) : ?>
        <img src='<?= $row['img_name'] . $page . $row['img_id']; ?>'"/>
    <?php endforeach; ?>
</div>