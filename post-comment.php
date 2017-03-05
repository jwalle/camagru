<?php
require_once 'install.php';

if (isset($_POST)) {
    $image->add_comment(
        $_POST['image-id'],
        $user->get_id($_SESSION['username']),
        $_POST['comment'],
        new DateTime('now')
    );
}
