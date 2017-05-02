<?php
include $_SERVER['DOCUMENT_ROOT'] . '/camagru/inc/bootstrap.php';
App::getAuth();
App::getDatabase()->query("DELETE FROM comments WHERE com_id = ?", [$_POST['com_id']]);
Session::getInstance()->setFlash('success', "Votre commentaire a bien ete supprime");