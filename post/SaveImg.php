<?php
    include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
    App::getAuth();
    $gallery = App::getGallery();
	define('UPLOAD_DIR', 'gallery/');
    $layer1 = $_POST['layer1Data'];
    $layer2 = $_POST['layer2Data'];
    $layer3 = $_POST['layer3Data'];
    $layer1 = str_replace('data:image/png;base64,' , '', $layer1);
    $layer2 = str_replace('data:image/png;base64,' , '', $layer2);
    $layer3 = str_replace('data:image/png;base64,' , '', $layer3);
	$layer1 = str_replace(' ' , '+', $layer1);
    $layer2 = str_replace(' ' , '+', $layer2);
    $layer3 = str_replace(' ' , '+', $layer3);
    $data1 = base64_decode($layer1);
    $data2 = base64_decode($layer2);
    $data3 = base64_decode($layer3);
    $im1 = imagecreatefromstring($data1);
    $im2 = imagecreatefromstring($data2);
    $im3 = imagecreatefromstring($data3);
    imagecopy($im1, $im3, 0, 0, 0, 0, 480, 360);
    imagecopy($im1, $im2, 0, 0, 0, 0, 480, 360);
	$file = UPLOAD_DIR . uniqid() . '.png';
	$success = imagepng($im1, '../' . $file);
    if ($success)
	{
	    $user_id = $_SESSION['auth']['user_name'];
        $gallery->add_image($file, $user_id);
	}
	else
	    print 'Unable to save the file.';