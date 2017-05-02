<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
App::getGallery()->delete_image($_POST['img_id']);