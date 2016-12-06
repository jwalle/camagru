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
	<?php include_once 'content.php'; ?>
</div>

<?php include_once 'footer.php'; ?>

</body>
</html>
