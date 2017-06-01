<?php
require '../inc/bootstrap.php';
App::getDatabase();
App::getAuth();
$img_id = $_POST['img'];
$user_id = $_SESSION['auth']['user_id'];
App::getImage($img_id)->vote($user_id, $img_id, $_POST['voteValue']);