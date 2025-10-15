<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - RB Lirio Medical & Diagnostic Clinic</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* ===== BASIC RESET ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
        }

        body {
            background: url("img/bg.jpg") center/cover no-repeat;
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: rgba(0,0,0,0.7);
            padding: 15px 40px;
            color: white;
            text-align: center;
            font-size: 1.8rem;
            letter-spacing: 1px;
            font-weight: bold;
        }

        /* ===== MAIN CONTAINER ===== */
        .dashboard-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 40px 20px;
        }

        .dashboard-box {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            width: 100%;
            max-width: 1100px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.4);
        }

        h2 {
            color: #222;
            text-align: center;
            margin-bottom: 30px;
            letter-spacing: 1px;
        }

        /* ===== GRID FOR STAT CARDS ===== */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.85);
            color: #222;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-6px);
        }

        .card h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
            color: #333;
        }

        .card p {
            font-size: 1.8rem;
            font-weight: bold;
            color: #0077b6;
        }

        /* ===== FOOTER ===== */
        footer {
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
            font-size: 0.9rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .dashboard-box {
                padding: 25px;
            }
        }
    </style>
</head>

<body>
    <header>
        RB Lirio Medical & Diagnostic Clinic Dashboard
    </header>

    <div class="dashboard-container">
        <div class="dashboard-box">
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
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>