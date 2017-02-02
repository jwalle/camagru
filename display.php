<?php

	require_once 'install.php';

	$img = $_POST['imgData'];
	$img = str_replace('data:image/png;base64,' , '', $img);
	$img = str_replace(' ' , '+', $img);
	$data = base64_decode($img);
	$user_id = $_SESSION['user_session'];
	$success = file_put_contents($file, $data);
?>
