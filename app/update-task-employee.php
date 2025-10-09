<?php
session_start();
include '../db_connection.php';

if (isset($_POST['update'])) {
	$task_id = $_POST["task_id"];
	$exp = "UPDATE tasks SET `status` = 'in_progress' WHERE id = $task_id";
	$upd = mysqli_query($sqli, $exp);
	if ($upd) {
		$em = "Task currently in progress";
		header("Location: ../my_task.php?success=$em");
		exit();
	} else {
		$em = "Unknown error occurred";
		header("Location: ../edit-task-employee.php?error=$em");
		exit();
	}
}
if (isset($_POST['done'])) {
	$task_id = $_POST["task_id"];
	$exp = "UPDATE tasks SET `status` = 'completed' WHERE id = $task_id";
	$upd = mysqli_query($sqli, $exp);
	if ($upd) {
		$em = "Task completed";
		header("Location: ../my_task.php?success=$em");
		exit();
	} else {
		$em = "Unknown error occurred";
		header("Location: ../edit-task-employee.php?error=$em");
		exit();
	}
}
