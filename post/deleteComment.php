<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
App::getDatabase()->query("DELETE FROM comments WHERE com_id = ?", [$_POST['comId']]);
App::getDatabase()->query("UPDATE gallery SET comments = comments - 1 WHERE img_id = ?", [$_POST['imgId']]);
Session::getInstance()->setFlash('success', "Votre commentaire a bien ete supprime");