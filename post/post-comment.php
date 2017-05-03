<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
if (isset($_POST)) {
    if ($_POST['comment']) {
        $date = new DateTime('now');
        App::getDatabase()->query("INSERT INTO comments(img_id, user_id, `comment`, `commented`) VALUES(?,?,?,?)",
            [$_POST['image-id'],
            $_SESSION['auth']['user_id'],
            $_POST['comment'],
            $date->format('Y-m-d H:i:s')]);
    }
    else {
        Session::getInstance()->setFlash('danger', 'Le commentaire doit contenir du texte.');
    }
}