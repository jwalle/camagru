<?php
require '../inc/bootstrap.php';
App::getAuth();
$imgUserName = App::getDatabase()->query("SELECT img_user FROM gallery WHERE img_id = ?", [$_POST['img_id']])->fetch();
if ($imgUserName[0] == $_SESSION['auth']['user_name']) {
    App::getGallery()->delete_image($_POST['img_id']);
    Session::getInstance()->setFlash('success', "Votre image a bien ete supprime");
}
else {
    Session::getInstance()->setFlash('danger', "Vous n'avez pas le droit de faire ça.");
}