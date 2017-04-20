<?php
require_once 'install.php';
include 'inc/bootstrap.php';
App::getAuth();
if (isset($_POST)) {
    $image->add_comment(
        $_POST['image-id'],
        $_SESSION['auth']['user_id'],
        $_POST['comment'],
        new DateTime('now')
    );
}