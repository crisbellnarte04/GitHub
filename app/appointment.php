<?php
include '../db_connection.php';
if (isset($_POST['appoint'])) {
	$fname = $_POST["first"];
	$lname = $_POST["last"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$date = $_POST["date"];
	$time = $_POST["time"];
	$gender = $_POST["gender"];
	$user_id = $_POST["user_id"];
	$purpose = $_POST["purpose"];

	$suffix = isset($_POST['suffix']) && !empty($_POST['suffix']) ? trim($_POST['suffix']) : '';
	$mname = isset($_POST['middle']) && !empty($_POST['middle']) ? trim($_POST['middle']) : '';


	$sql = "INSERT INTO `appointments`( `user_id`, `fname`, `mname`, `lname`, `suffix`, `email`, `phone`, `gender`, `purpose`, `date`, `time`,`stat`) VALUES ('$user_id','$fname', '$lname','$mname', '$suffix', '$email', '$phone', '$gender', '$purpose','$date','$time','pending')";
	$result = mysqli_query($sqli, $sql);
	if ($result) {
		$res = [
			'status' => 201,
			'msg' => "Appointment Submitted successfully",
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
}
if (isset($_POST['assigned'])) {

	$b_id = $_POST["b_id"];
	$doc = $_POST["doc"];


	$sql = "UPDATE `appointments` SET `stat`='accept',`d_id`='$doc' WHERE `b_id` ='$b_id'";
	$result = mysqli_query($sqli, $sql);
	if ($result) {
		$res = [
			'status' => 201,
			'msg' => "Appointment Accepted successfully",
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
}
if (isset($_POST['done'])) {

	$b_id = $_POST["b_id"];


	$sql = "UPDATE `appointments` SET `stat`='completed' WHERE `b_id` ='$b_id'";
	$result = mysqli_query($sqli, $sql);
	if ($result) {
		$res = [
			'status' => 201,
			'msg' => "Appointment Completed successfully",
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
}
