<?php
$servername = "localhost";
$username = "root";
$password = "root";

// Create connection

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

$req = "CREATE TABLE IF NOT EXISTS `users` (`username` varchar(255) NOT NULL,`password` varchar(255) NOT NULL, UNIQUE KEY `username` (`username`)) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

$conn->exec($req);


$conn = null;
?>