<?php
$sName = "localhost";
$uName = "root";
$pass  = "";
$db_name = "user";

try {
	$conn = new PDO("mysql:host=$sName;dbname=$db_name", $uName, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	exit;
}
$sqli = mysqli_connect($sName, $uName, $pass, $db_name);
if (!$sqli) {
	die("Error" . mysqli_connect_error());
}

