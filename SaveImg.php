<?php
	session_start();
	require_once 'install.php';
	define('UPLOAD_DIR', 'gallery/');
	$img = $_POST['imgData'];
	$img = str_replace('data:image/png;base64,' , '', $img);
	$img = str_replace(' ' , '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$user_id = $_SESSION['username'];
	$success = file_put_contents($file, $data);

	if ($success)
	{	
		$gallery->add_image($file, $user_id);
	}
	else
	print 'Unable to save the file.';
