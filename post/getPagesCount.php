<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
echo App::getGallery()->getImagesCount();