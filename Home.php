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

<?php include_once 'Header.php'; ?>

<body>

<div class="rows">
<?php include_once 'side_bar.php'; ?>
	<div class ="header">

		<div class="left">
		<label><a href="https://www.reddit.com/">Reddit !!</a></label>
		</div>

		<div class="right">
		<label><a href="logout.php?logout=true"><i class="glyphicon"></i>logout</a></label>
		</div>

	</div>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>
