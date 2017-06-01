<?php
require '../inc/bootstrap.php';
App::getAuth();
$comUserId = App::getDatabase()->query("SELECT user_id FROM comments WHERE com_id = ?", [$_POST['comId']])->fetch();
if ($comUserId[0] == $_SESSION['auth']['user_id']) {
    App::getDatabase()->query("DELETE FROM comments WHERE com_id = ?", [$_POST['comId']]);
    App::getDatabase()->query("UPDATE gallery SET comments = comments - 1 WHERE img_id = ?", [$_POST['imgId']]);
    Session::getInstance()->setFlash('success', "Votre commentaire a bien ete supprime");
}
else {
    Session::getInstance()->setFlash('danger', "Vous n'avez pas le droit de faire ça.");
}