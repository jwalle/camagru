<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create database

try {
		$conn = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE DATABASE IF NOT EXISTS camagru";
		$conn->exec($sql);
		echo "Database created successfully<br>";
	}
catch (PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}

// Create table

try {
	$table = "user";
	$conn = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
	$req = "CREATE TABLE IF NOT EXISTS $table (
		ID INT(11) AUTO_INCREMENT PRIMARY KEY,
		username varchar(255) NOT NULL,
		password varchar(255) NOT NULL);";
	$conn->exec($req);
	print("created $table Table.\n");
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}

// Insert element in table

try {
		$conn = new PDO("mysql:host=$servername;dbname=camagru", $username, $password);
		$hash = hash('whirlpool', 'motdepasse');
		$name = 'kkak';
		$stmt =  $conn->prepare("INSERT INTO $table set username=?, password=?");
		$stmt->execute([$name, $hash]);
		echo "Insert done";
	}
	catch (PDOException $e)
	{
		echo $sql . "<br>" . $e->getMessage();
	}
	$conn = null;
?>