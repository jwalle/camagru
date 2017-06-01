<?php
if ($auth->user()) {
	App::redirect('index.php?page=content');
} else
    App::redirect('index.php?page=sign-in');
?>
