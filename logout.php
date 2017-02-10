<?php

if ($user->logout())
{
    $user->redirect('index.php');
}

?>