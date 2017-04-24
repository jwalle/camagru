<?php
require_once 'install.php';
require_once 'config/database.php';
include 'inc/bootstrap.php';
App::getDatabase($DB_DSN, $DB_USER, $DB_PASSWORD);
App::getAuth();
$voteValue = $_POST['voteValue'];
$img_id = $_POST['img'];
$user_id = $_POST["user"];
App::getImage($img_id)->vote($user_id, $img_id, $voteValue);