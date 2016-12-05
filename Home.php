<?php

include_once 'install.php';

if ($user->is_loggedin() === false)
{
	$user->redirect('index.php');
}

$user_id = $_SESSION['user_session'];
$stmt = $conn->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
		<link rel="icon" type="image/png" href="/img/logo.png">
		<title>welcome - <?php print($userRow['user_name']); ?></title>
	</head>
<body bgcolor="#A69256">

<?php include_once 'top_bar.php'; ?>

<div class="row">
<?php include_once 'side_bar.php'; ?>
	<div class ="header">

		<div class="left">
		<label><a href="https://www.reddit.com/">Reddit !!</a></label>
		</div>

		<div class="right">
		<label><a href="logout.php?logout=true"><i class="glyphicon"></i>logout</a></label>
		</div>

	</div>

<div class="content">
	 welcome :  <?php print($userRow['user_name']); ?>
</div>

</div>

<footer>
	<a class="button3" href="http://localhost:8080/phpmyadmin/" >Accès Admin</a>

</body>
</html>
