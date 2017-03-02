<?php
session_start();
require_once 'install.php';
$voteValue = $_POST['voteValue'];
$img_id = $_POST["img"];
$user_id = $_POST["user"];
$image->vote($user_id, $img_id, $voteValue);