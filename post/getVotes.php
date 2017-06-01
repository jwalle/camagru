<?php
require '../inc/bootstrap.php';
App::getAuth();
App::getDatabase();
echo App::getImage($_POST['image'])->get_sum_votes($_POST['image']);
