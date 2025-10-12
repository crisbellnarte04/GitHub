<?php
include '../db_connection.php';
if (isset($_POST['signup'])) {
	$fname = $_POST["first"];
	$username = $_POST["username"];
	$lname = $_POST["last"];
	$password = $_POST["pass1"];
	$password2 = $_POST["pass2"];
	$suffix = isset($_POST['suffix']) && !empty($_POST['suffix']) ? trim($_POST['suffix']) : '';
	$mname = isset($_POST['middle']) && !empty($_POST['middle']) ? trim($_POST['middle']) : '';
	$full_name = $fname.' '.$lname;

				if (($password == $password2)) {
					$hash = password_hash($password, PASSWORD_DEFAULT);
					$sql = "INSERT INTO `users`( `fname`, `mname`, `lname`, `suffix`, `full_name`, `username`, `password`, `role`) VALUES ('$fname', '$lname','$mname', '$suffix', '$full_name', '$username', '$hash', 'user')";
					$result = mysqli_query($sqli, $sql);
					if ($result) {
						$res = [
							'status' => 201,
							'msg' => "Account created successfully",
						];
						echo json_encode($res);
						exit;
					} else {
						$res = [
							'status' => 401,
							'msg' => "Something went wrong",
						];
						echo json_encode($res);
						exit;
					}
				} else {
					$res = [
						'status' => 401,
						'msg' => "Password doesn't match",
					];
					echo json_encode($res);
					exit;
				}
			}
		

