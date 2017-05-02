<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getDatabase();
App::getAuth();
$voteValue = $_POST['voteValue'];
$img_id = $_POST['img'];
$user_id = $_POST["user"];
App::getImage($img_id)->vote($user_id, $img_id, $voteValue);