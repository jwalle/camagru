<?php
require_once 'install.php';
require_once 'config/database.php';
include 'inc/bootstrap.php';
App::getAuth();
if (isset($_POST)) {
    if ($_POST['comment']) {
        $date = new DateTime('now');
        App::getDatabase($DB_DSN, $DB_USER, $DB_PASSWORD)->query("INSERT INTO comments(img_id, user_id, `comment`, `commented`) VALUES(?,?,?,?)",
            [$_POST['image-id'],
            $_SESSION['auth']['user_id'],
            $_POST['comment'],
            $date->format('Y-m-d H:i:s')]);
    }
    else {
        Session::getInstance()->setFlash('danger', 'Le commentaire doit contenir du texte.');
    }
}