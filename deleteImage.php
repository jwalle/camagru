<?php
session_start();
require_once 'install.php';
$img_id = $_POST['img_id'];
$gallery->delete_image($img_id);
