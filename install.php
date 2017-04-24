<?php

include_once("config/database.php");

 //Create database

 try {
 		$conn = new PDO("mysql:$DB_DSN", $DB_USER, $DB_PASSWORD);
 		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 		$req = "CREATE DATABASE IF NOT EXISTS camagru";
 		$conn->exec($req);
 	}
 	catch (PDOException $e)
 	{
 		echo $req . "<br>" . $e->getMessage();
 	}

 // Create table

 try {
 	$table = "users";
 	$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 	$req = "CREATE TABLE IF NOT EXISTS $table (
 		user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
 		user_name varchar(255) NOT NULL,
 		user_mail varchar(60) NOT NULL,
 		user_pass varchar(255) NOT NULL,
 		user_token varchar(60) NULL,
 		reset_token varchar(60) NULL,
 		confirmed_at DATETIME NULL,
 		reset_at DATETIME NULL,
 		UNIQUE (`user_name`),
 		UNIQUE (`user_mail`));";
 	$conn->exec($req);
 	}
 	catch (PDOException $e)
 	{
 		echo $req . "<br>" . $e->getMessage();
 	}

 try {
 	$table = "gallery";
 	$conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = "CREATE TABLE IF NOT EXISTS $table (
 		img_id INT(11) AUTO_INCREMENT PRIMARY KEY,
 		img_name varchar(255) NOT NULL,
 		img_user varchar(255) NOT NULL,
 		UNIQUE (`img_name`));";
 	$conn->exec($req);
 	}
 	catch (PDOException $e)
 	{
 		echo $req . "<br>" . $e->getMessage();
 	}

try {
    $table = "comments";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = "CREATE TABLE IF NOT EXISTS $table (
 		com_id INT(11) AUTO_INCREMENT PRIMARY KEY,
 		user_id INT(11) NOT NULL,
 		img_id INT(11) NOT NULL,
 		comment VARCHAR(10000),
 		commented DATETIME NOT NULL);";
    $conn->exec($req);
	}
catch (PDOException $e)
{
    echo $req . "<br>" . $e->getMessage();
}

try {
    $table = "votes";
    $conn = new PDO("mysql:host=$DB_DSN;dbname=camagru", $DB_USER, $DB_PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $req = "CREATE TABLE IF NOT EXISTS $table (
 		vote_id INT(11) AUTO_INCREMENT PRIMARY KEY,
 		user_id INT(11) NOT NULL,
 		vote_value INT(2) NULL,
 		img_id INT(11) NOT NULL);";
    $conn->exec($req);
}
catch (PDOException $e)
{
    echo $req . "<br>" . $e->getMessage();
}

include_once 'Class_User.php';
include_once 'Class_Gallery.php';

$user = new USER($conn);
$gallery = new GALLERY($conn);

if (!file_exists('gallery'))
	mkdir('gallery');