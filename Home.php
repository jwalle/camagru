<?php

if ($user->is_loggedin() === false)
{
	$user->redirect('index.php?page=register');
}

$user_id = $_SESSION['user_session'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user->is_loggedin())
{
	$user->redirect('index.php?page=content');
}
else
    $user->redirect('index.php?page=sign-in');
?>
