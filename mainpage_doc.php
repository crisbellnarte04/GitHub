<?php 
session_start();

// Check if user is logged in with role and id
if (isset($_SESSION['role']) && isset($_SESSION['id'])) {

    include "db_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";

    // Initialize variables
    $todaydue_task = 0;
    $overdue_task = 0;
    $nodeadline_task = 0;
    $num_task = 0;
    $num_users = 0;
    $pending = 0;
    $in_progress = 0;
    $completed = 0;
    $num_my_task = 0;

    $user_id = $_SESSION['id'];

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

    } else if ($_SESSION['role'] === "employee" || $_SESSION['role'] === "doctor") {
        $num_my_task = count_my_tasks($conn, $user_id);
        $overdue_task = count_my_tasks_overdue($conn, $user_id);
        $nodeadline_task = count_my_tasks_NoDeadline($conn, $user_id);
        $pending = count_my_pending_tasks($conn, $user_id);
        $in_progress = count_my_in_progress_tasks($conn, $user_id);
        $completed = count_my_completed_tasks($conn, $user_id);
    } else {
        // Unknown role
        header("Location: login.php?error=Unknown role");
        exit();
    }

} else {
    // Not logged in
    header("Location: login.php?error=Please login first");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Doctor Dashboard - RB Lirio Medical & Diagnostic Clinic</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

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

        .body {
            display: flex;
            flex: 1;
        }

        .section-1 {
            flex: 1;
            padding: 40px;
        }

        .dashboard {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: 30px 40px;
            border-radius: 10px;
            max-width: 900px;
            margin: 0 auto;
            color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .dashboard h2 {
            margin-bottom: 25px;
            font-size: 2rem;
            text-align: center;
            color: #000;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
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
            font-size: 1.1rem;
            margin-bottom: 8px;
        }

        .card p {
            font-size: 1.4rem;
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
    <input type="checkbox" id="checkbox">

    <?php include "inc/header.php"; ?>
    
    <div class="body">
        <?php include "inc/nav.php"; ?>

        <section class="section-1">
            <div class="dashboard">
                <h2>Welcome, Dr. <?php echo $_SESSION['name'] ?? 'Doctor'; ?>!</h2>
                <div class="stats-grid">
                    <div class="card">
                        <h3>My Tasks</h3>
                        <p><?php echo $num_my_task; ?></p>
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
                    <div class="card">
                        <h3>No Deadline</h3>
                        <p><?php echo $nodeadline_task; ?></p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer>
        <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
    </footer>
</body>
</html>
