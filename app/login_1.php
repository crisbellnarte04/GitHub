<?php
session_start();
include_once "db_config.php";

if (isset($_POST['register'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$role = $_POST['role'];

	$checkEmail = $conn->query("SELECT email FROM login WHERE email = '$email'");
	if ($checkEmail->num_rows > 0) {
		$_SESSION['register_error'] = 'Email is already registered!';
		$_SESSION['active_form'] = 'Register';
	} else {
		$conn->query("INSERT INTO login (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
	}

	header("Location: login.php");
	exit();
}
?>