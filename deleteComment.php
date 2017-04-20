<?php
require_once 'install.php';
include 'inc/bootstrap.php';
App::getAuth();
$com_id = $_POST['com_id'];
$image->delete_comment($com_id);
