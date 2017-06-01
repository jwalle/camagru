<?php
require '../inc/bootstrap.php';
App::getAuth();
echo App::getGallery()->getImagesCount();
