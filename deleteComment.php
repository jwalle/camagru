<?php
require_once 'install.php';
require_once 'config/database.php';
include 'inc/bootstrap.php';
App::getAuth();
App::getDatabase($DB_DSN, $DB_USER, $DB_PASSWORD)->query("DELETE FROM comments WHERE com_id = ?", [$_POST['com_id']]);
Session::getInstance()->setFlash('success', "Votre commentaire a bien ete supprime");
Session::getInstance()->setFlash('danger', "Blabla deuxieme message");