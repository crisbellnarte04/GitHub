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
    } else {
        $num_my_task = count_my_tasks($conn, $_SESSION['id']);
        $overdue_task = count_my_tasks_overdue($conn, $_SESSION['id']);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $_SESSION['id']);
        $pending = count_my_pending_tasks($conn, $_SESSION['id']);
        $in_progress = count_my_in_progress_tasks($conn, $_SESSION['id']);
        $completed = count_my_completed_tasks($conn, $_SESSION['id']);
    }

} else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - RB Lirio Medical & Diagnostic Clinic</title>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Times New Roman', serif;
    }

    body {
        background: url("img/bg.jpg") center/cover no-repeat;
        color: #000;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    header nav {
        background: rgba(0, 0, 0, 0.6);
        padding: 10px 0;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .logo {
        font-weight: bold;
        margin-left: 20px;
        color: white;
    }

    .nav-links {
        list-style: none;
        display: flex;
        gap: 15px;
        justify-content: flex-end;
        margin-right: 20px;
    }

    .nav-links a {
        color: white;
        text-decoration: none;
        padding: 8px 12px;
        border-radius: 5px;
        transition: background 0.3s;
    }

    .nav-links a:hover,
    .nav-links .active {
        background: rgba(255, 255, 255, 0.2);
    }

    .container {
    margin-left: 220px; /* sidebar width */
    margin-top: 70px;   /* header height */
    padding: 40px;
    flex: 1;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}


    .dashboard {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        padding: 30px 40px;
        border-radius: 10px;
        max-width: 800px;
        width: 100%;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .dashboard h2 {
        margin-bottom: 20px;
        font-size: 2rem;
        color: #2d2c2cff;
        text-align: center;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 15px;
    }

    .card {
        background: rgba(0, 0, 0, 0.4);
        padding: 15px;
        border-radius: 8px;
        text-align: center;
        transition: transform 0.3s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card h3 {
        margin-bottom: 8px;
        font-size: 1.1rem;
    }

    .card p {
        font-size: 1.3rem;
        font-weight: bold;
        color: #fff;
    }

    footer {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        text-align: center;
        padding: 10px 0;
        width: 100%;
        font-size: 14px;
        position: relative;
    }
</style>
</head>

<body>
<?php include "inc/header.php"; ?>
    <?php include "inc/nav.php"; ?>
<div class="container">
    <div class="dashboard">
        <h2>Welcome, <?php echo ucfirst($_SESSION['role']); ?>!</h2>
        <div class="stats-grid">
            <?php if ($_SESSION['role'] === "admin") { ?>
                <div class="card">
                    <h3>Total Tasks</h3>
                    <p><?php echo $num_task; ?></p>
                </div>
                <div class="card">
                    <h3>Users</h3>
                    <p><?php echo $num_users; ?></p>
                </div>
                <div class="card">
                    <h3>Pending</h3>
                    <p><?php echo $pending; ?></p>
                </div>
                <div class="card">
                    <h3>In Progress</h3>
                    <p><?php echo $in_progress; ?></p>
                </div>
                <div class="card">
                    <h3>Completed</h3>
                    <p><?php echo $completed; ?></p>
                </div>
                <div class="card">
                    <h3>Overdue</h3>
                    <p><?php echo $overdue_task; ?></p>
                </div>
            <?php } else { ?>
                
            <?php } ?>
        </div>
    </div>
</div>

<footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
</footer>
</body>
</html>
