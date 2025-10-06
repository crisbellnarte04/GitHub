<?php 
session_start();
if (isset($_POST['user_name']) && isset($_POST['password'])) {
	include "../db_connection.php";

    function validate_input($data) {
	  return htmlspecialchars(stripslashes(trim($data)));
	}

	$user_name = validate_input($_POST['user_name']);
	$password = validate_input($_POST['password']);

	if (empty($user_name) || empty($password)) {
	    header("Location: login.php?error=Username and Password required");
	    exit();
	}

	$sql = "SELECT * FROM users WHERE username = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$user_name]);

	if ($stmt->rowCount() === 1) {
		$user = $stmt->fetch();
		if (password_verify($password, $user['password'])) {
			$_SESSION['id'] = $user['id'];
			$_SESSION['username'] = $user['username'];
			$_SESSION['role'] = $user['role'];

			// Redirect based on role
			if ($user['role'] === "admin") {
				header("Location: ../index.php");
			} else {
				header("Location: ../index.php");
			}
			exit();
		}
	}

	header("Location: login.php?error=Incorrect username or password");
	exit();
} else {
	header("Location: login.php");
	exit();
}
