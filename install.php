<?php

include("config/database.php");
session_start();
// Create database

try {
		$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
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
	$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
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
		$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
		$hash = hash('whirlpool', 'motdepasse');
		$name = 'plop1';
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