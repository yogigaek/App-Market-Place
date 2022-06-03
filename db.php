<?php 
	$hostname 	= 'localhost';
	$username 	= 'root';
	$password 	= 'root';
	$dbname		= 'db_tokoyogi';

	$conn = mysqli_connect($hostname, $username, $password, $dbname) or die('Gagal terhubung ke database');
 ?>