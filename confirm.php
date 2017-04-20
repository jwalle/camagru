<?php

if (App::getAuth()->confirm($db, $_GET['id'], $_GET['token'])) {
    Session::getInstance()->setFlash('success', "Votre compte est valide");
    App::redirect('index.php');
} else {
    Session::getInstance()->setFlash('danger', "Ce token n'est pas valide");
    App::redirect('index.php');
}