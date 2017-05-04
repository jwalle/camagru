<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
if (isset($_POST)) {
    if ($_POST['comment']) {
        $date = new DateTime('now');
        App::getDatabase()->query("INSERT INTO comments(img_id, user_id, `comment`, `commented`) VALUES(?,?,?,?)",
            [$_POST['image-id'],
            $_SESSION['auth']['user_id'],
            App::cleanUp($_POST['comment']),
            $date->format('Y-m-d H:i:s')]);
        App::getDatabase()->query('UPDATE gallery SET comments = comments + 1 WHERE img_id = ?', [$_POST['image-id']]);
        $email = App::getImage($_POST['image-id'])->getImageUser()['user_mail'];
        $sujet = "Commentaire camagru";
        $content = "L'une de vos creation viens de recevoir un commentaire de la part de "
            . $_SESSION['auth']['user_name'] . ' !';
        mail($email, $sujet, $content);
    }
    else {
        Session::getInstance()->setFlash('danger', 'Le commentaire doit contenir du texte.');
    }
}