<?php

session_start();

include_once("config/database.php");
	
// //Create database

// try {
// 		$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
// 		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// 		$sql = "CREATE DATABASE IF NOT EXISTS camagru";
// 		$conn->exec($sql);
// 		echo "Database created successfully<br>";
// 	}
// 	catch (PDOException $e)
// 	{
// 		echo $sql . "<br>" . $e->getMessage();
// 	}

// // Create table

// try {
// 	$table = "users";
// 	$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
// 	$req = "CREATE TABLE IF NOT EXISTS $table (
// 		user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
// 		user_name varchar(255) NOT NULL,
// 		user_mail varchar(60) NOT NULL,
// 		user_pass varchar(255) NOT NULL,
// 		UNIQUE (`user_name`),
// 		UNIQUE (`user_mail`));";
// 	$conn->exec($req);
// 	print("created $table Table.\n");
// 	}
// 	catch (PDOException $e)
// 	{
// 		echo $sql . "<br>" . $e->getMessage();
// 	}

// try {
// 	$table = "gallery";
// 	$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
// 	$req = "CREATE TABLE IF NOT EXISTS $table (
// 		img_id INT(11) AUTO_INCREMENT PRIMARY KEY,
// 		img_name varchar(255) NOT NULL,
// 		img_user varchar(255) NOT NULL,
// 		UNIQUE (`img_name`));";
// 	$conn->exec($req);
// 	print("created $table Table.\n");
// 	}
// 	catch (PDOException $e)
// 	{
// 		echo $sql . "<br>" . $e->getMessage();
// 	}

	try
	{
		$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e)
	{
	echo $sql . "<br>" . $e->getMessage();
	}

	include_once 'Class_User.php';
	include_once 'Class_Gallery.php';

	$user = new USER($conn);
	$gallery = new GALLERY($conn);
	
	if (!file_exists('gallery'))
		mkdir('gallery', 0777, true);

// Insert element in table
// try {
// 		$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
// 		$hash = hash('whirlpool', 'motdepasse');
// 		$name = 'plop1';
// 		$mail = 'coucou@gmail.com';
// 		$stmt =  $conn->prepare("INSERT INTO $table set user_name=?, user_mail=?, user_pass=?");
// 		$stmt->execute([$name, $mail, $hash]);
// 		echo "Insert done";
// 	}
// 	catch (PDOException $e)	
// 	{
// 		echo $sql . "<br>" . $e->getMessage();
// 	}
// 	$conn = null;
?>
