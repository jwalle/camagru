<?php
session_start();
require_once 'install.php';
$com_id = $_POST['com_id'];
$image->delete_comment($com_id);

