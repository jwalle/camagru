<?php
require_once 'install.php';
include 'inc/bootstrap.php';
App::getAuth();
if (isset($_POST)) {
    if ($_POST['comment']) {
        $image->add_comment(
            $_POST['image-id'],
            $_SESSION['auth']['user_id'],
            $_POST['comment'],
            new DateTime('now')
        );
    }
    else {
        Session::getInstance()->setFlash('danger', 'Le commentaire doit contenir du texte.');
    }
}