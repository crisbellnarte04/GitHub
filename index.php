<?php
session_start();

// Check if user is logged in with role and id
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    include "db_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

    // Initialize variables to avoid undefined variable warnings
    $todaydue_task = 0;
    $overdue_task = 0;
    $nodeadline_task = 0;
    $num_task = 0;
    $num_users = 0;
    $pending = 0;
    $in_progress = 0;
    $completed = 0;
    $num_my_task = 0;

    // Check user role and get relevant data
    if ($_SESSION['role'] === "admin") {
        $todaydue_task = count_tasks_due_today($conn);
        $overdue_task = count_tasks_overdue($conn);
        $nodeadline_task = count_tasks_NoDeadline($conn);
        $num_task = count_tasks($conn);
        $num_users = count_users($conn);
        $pending = count_pending_tasks($conn);
        $in_progress = count_in_progress_tasks($conn);
        $completed = count_completed_tasks($conn);
        //$num_appointments = $conn->query("SELECT COUNT(*) FROM book")->fetchColumn();

    } else if ($_SESSION['role'] === "employee") {
        $num_my_task = count_my_tasks($conn, $_SESSION['id']);
        $overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
        $pending = count_my_pending_tasks($conn, $_SESSION['id']);
        $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
        $completed = count_my_completed_tasks($conn, $_SESSION['id']);
        //$num_appointments = $conn->query("SELECT COUNT(*) FROM book WHERE Username = '".$_SESSION['username']."'")->fetchColumn();


    } else if ($_SESSION['role'] === "doctor") {
        $num_my_task = count_my_tasks($conn, $_SESSION['id']);
        $overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
        $pending = count_my_pending_tasks($conn, $_SESSION['id']);
        $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
        $completed = count_my_completed_tasks($conn, $_SESSION['id']);
        //$num_appointments = $conn->query("SELECT COUNT(*) FROM book WHERE Username = '".$_SESSION['username']."'")->fetchColumn();


    } else {
        // Unknown role, redirect to login
        $em = "Unknown role";
        header("Location: login.php?error=$em");
        exit();
    }
} else {
    // Not logged in, redirect to login
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <input type="checkbox" id="checkbox">
    <?php include "inc/header.php"; ?>
    <div class="body">
        <?php include "inc/nav.php"; ?>
        <section class="section-1">
            <?php if ($_SESSION['role'] === "admin") { ?>

            <?php } else { ?>

            <?php } ?>
        </section>
    </div>


</body>

</html>