<?php
App::getAuth()->logout();
Session::getInstance()->setFlash('success', "Vous etes maintenant deconnecte");
App::redirect("index.php");