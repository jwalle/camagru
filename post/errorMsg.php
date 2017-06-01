<?php
require '../inc/bootstrap.php';
App::getAuth();
if (isset($_POST['msg']))
Session::getInstance()->setFlash('danger', $_POST['msg']);
