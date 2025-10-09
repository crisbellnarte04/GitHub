<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "db_connection.php";
    include "app/Model/Task.php";
    include "app/Model/User.php";
    include "inc/bootstrap.php";
    $today = date('Y-m-d');

    $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` = :today");
    $stmt->execute(['today' => $today]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $due_today = $stmt->rowCount();

    $stmt = $conn->prepare("SELECT * FROM `tasks`");
    $stmt->execute();
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $all_task = $stmt->rowCount();

    $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` < :overdue ");
    $stmt->execute(['overdue' => $today]);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $over_due = $stmt->rowCount();

    $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` = :no_dead");
    $stmt->execute(['no_dead' => '0000-00-00']);
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $no_dead = $stmt->rowCount();
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>All Tasks</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">

    </head>
    <style>
        .nav-link.active .count {
            color: red;
            font-size: 20px;
        }

        .count {
            font-weight: 600;
            letter-spacing: 3px;
            color: #6c757d;
            /* Bootstrap muted */
        }
    </style>

    <body>
        <input type="checkbox" id="checkbox">
        <?php include "inc/header.php" ?>
        <div class="body">
            <?php include "inc/nav.php" ?>
            <section class="section-1">
                <div class="card-header" style="background-color:transparent;border:none;">
                    <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">
                                <br>
                                <span style="color:black; letter-spacing:3px; " class="font-weight-bold">ALL TASK
                                    <sup class="count"><?php echo $all_task; ?></sup>
                                </span>

                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="due_today-tab" data-bs-toggle="tab" data-bs-target="#due_today" type="button" role="tab" aria-controls="due_today" aria-selected="true">
                                <br>
                                <span style="color:black; letter-spacing:3px;" class="text-uppercase font-weight-bold ">DUE TODAY
                                    <sup class="count"><?php echo $due_today; ?></sup>
                                </span>

                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="over_due-tab" data-bs-toggle="tab" data-bs-target="#over_due" type="button" role="tab" aria-controls="over_due" aria-selected="true">
                                <br>
                                <span style="color:black; letter-spacing:3px;" class="text-uppercase font-weight-bold ">OVERDUE
                                    <sup class="count"><?php echo $over_due; ?></sup>

                                </span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="true">
                                <br>
                                <span style="color:black; letter-spacing:3px;" class="text-uppercase font-weight-bold">NO DEADLINE
                                    <sup class="count"><?= $no_dead ?></sup>

                                </span>
                            </button>
                        </li>
                    </ul>
                </div>
                <?php if (isset($_GET['success'])) { ?>
                    <div class="success" role="alert">
                        <?php echo stripcslashes($_GET['success']); ?>
                    </div>
                <?php } ?>
                <div class="card mt-5">
                    <div class="tab-content">
                        <div class="tab-pane active" id="pending" role="tabpanel" aria-labelledby="pending-tab" tabindex="0">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card m-3 overflow-auto" style="border:none;">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered first">
                                                    <thead class="bg-light">
                                                        <tr class="border-0">
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;"></th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">TITLE</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DESCRIPTION</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ASSIGNED TO</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DUE DATE</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">STATUS</th>

                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $count = 0;

                                                        // 1. Fetch all pending tasks
                                                        $stmt = $conn->prepare("SELECT * FROM `tasks`");
                                                        $stmt->execute();
                                                        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($tasks as $row) {
                                                            $id   = $row['id'];
                                                            $title   = $row['title'];
                                                            $description     = $row['description'];
                                                            $assigned_to    = $row['assigned_to'];
                                                            $due_date   = $row['due_date'];
                                                            $status = $row['status'];
                                                            $due_date = date_format(date_create($due_date), "M/d/Y");
                                                            switch ($status) {
                                                                case 'pending':
                                                                    $badgeClass = 'bg-warning';

                                                                    break;

                                                                case 'in_progress':
                                                                    $badgeClass = 'bg-primary';

                                                                    break;

                                                                case 'completed':
                                                                    $badgeClass = 'bg-success';
                                                                    break;

                                                                default:
                                                            }

                                                            $stmt_user = $conn->prepare("SELECT * FROM `users` WHERE `id` = :assigned_to");
                                                            $stmt_user->execute(['assigned_to' => $assigned_to]);
                                                            $users = $stmt_user->fetch(PDO::FETCH_ASSOC);

                                                            $full_name = $users['full_name'] ?? 'N/A';

                                                            $count++;

                                                            echo '
                                                            <tr>
                                                                <td style="font-size: 18px;" class="text-center">' . $count . '</td>
                                                                <td style="font-size: 15px;" class="text-center text-uppercase">
                                                        ' . $title . '
                                                                </td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($description) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($full_name) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($due_date) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">
                                                                 <span class="badge rounded-pill text-bg     '.$badgeClass.' p-2 text-capitalize" style="letter-spacing:1px; font-size:13px;">'.$status.'</span>
                                                                </td>
                                                            <td class="text-center">
                                                                                <a href="edit-task.php?id=' . $id . '" class="edit-btn">Edit</a>
                                                                                <a href="delete-task.php?id=' . $id . '" class="delete-btn">Delete</a>
                                                                    
                                                            
                                                            </tr>';
                                                        }
                                                        ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="due_today" role="tabpanel" aria-labelledby="due_today-tab" tabindex="0">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card m-3 overflow-auto" style="border:none;">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered first">
                                                    <thead class="bg-light">
                                                        <tr class="border-0">
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;"></th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">TITLE</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DESCRIPTION</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ASSIGNED TO</th>

                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` = :today");

                                                        $stmt->execute(['today' => $today]);

                                                        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($tasks as $row) {
                                                            $id   = $row['id'];
                                                            $title   = $row['title'];
                                                            $description     = $row['description'];
                                                            $assigned_to    = $row['assigned_to'];
                                                            $due_date   = $row['due_date'];


                                                            $stmt_user = $conn->prepare("SELECT * FROM `users` WHERE `id` = :assigned_to");
                                                            $stmt_user->execute(['assigned_to' => $assigned_to]);
                                                            $users = $stmt_user->fetch(PDO::FETCH_ASSOC);

                                                            $full_name = $users['full_name'] ?? 'N/A';

                                                            $count++;

                                                            echo '
                                                            <tr>
                                                                <td style="font-size: 18px;" class="text-center">' . $count . '</td>
                                                                <td style="font-size: 15px;" class="text-center text-uppercase">
                                                        ' . $title . '
                                                                </td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($description) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($full_name) . '</td>
                                                             
                                                            <td class="text-center">
                                                                                <a href="edit-task.php?id=' . $id . '" class="edit-btn">Edit</a>
                                                                                <a href="delete-task.php?id=' . $id . '" class="delete-btn">Delete</a>
                                                                    
                                                            
                                                            </tr>';
                                                        }
                                                        ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="over_due" role="tabpanel" aria-labelledby="over_due-tab" tabindex="0">

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card m-3 overflow-auto" style="border:none;">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered first">
                                                    <thead class="bg-light">
                                                        <tr class="border-0">
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;"></th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">TITLE</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DESCRIPTION</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ASSIGNED TO</th>

                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` < :today");

                                                        $stmt->execute(['today' => $today]);

                                                        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($tasks as $row) {
                                                            $id   = $row['id'];
                                                            $title   = $row['title'];
                                                            $description     = $row['description'];
                                                            $assigned_to    = $row['assigned_to'];
                                                            $due_date   = $row['due_date'];


                                                            $stmt_user = $conn->prepare("SELECT * FROM `users` WHERE `id` = :assigned_to");
                                                            $stmt_user->execute(['assigned_to' => $assigned_to]);
                                                            $users = $stmt_user->fetch(PDO::FETCH_ASSOC);

                                                            $full_name = $users['full_name'] ?? 'N/A';

                                                            $count++;

                                                            echo '
                                                            <tr>
                                                                <td style="font-size: 18px;" class="text-center">' . $count . '</td>
                                                                <td style="font-size: 15px;" class="text-center text-uppercase">
                                                        ' . $title . '
                                                                </td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($description) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($full_name) . '</td>
                                                             
                                                            <td class="text-center">
                                                                                <a href="edit-task.php?id=' . $id . '" class="edit-btn">Edit</a>
                                                                                <a href="delete-task.php?id=' . $id . '" class="delete-btn">Delete</a>
                                                                    
                                                            
                                                            </tr>';
                                                        }
                                                        ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="completed" role="tabpanel" aria-labelledby="completed-tab" tabindex="0">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card m-3 overflow-auto" style="border:none;">
                                    <div class="card-body">
                                        <div class="row ">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered first">
                                                    <thead class="bg-light">
                                                        <tr class="border-0">
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;"></th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">TITLE</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">DESCRIPTION</th>
                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ASSIGNED TO</th>

                                                            <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        $stmt = $conn->prepare("SELECT * FROM `tasks` WHERE `due_date` = :no_dead");
                                                        $stmt->execute(['no_dead' => '0000-00-00']);
                                                        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                                        foreach ($tasks as $row) {
                                                            $id   = $row['id'];
                                                            $title   = $row['title'];
                                                            $description     = $row['description'];
                                                            $assigned_to    = $row['assigned_to'];
                                                            $due_date   = $row['due_date'];


                                                            $stmt_user = $conn->prepare("SELECT * FROM `users` WHERE `id` = :assigned_to");
                                                            $stmt_user->execute(['assigned_to' => $assigned_to]);
                                                            $users = $stmt_user->fetch(PDO::FETCH_ASSOC);

                                                            $full_name = $users['full_name'] ?? 'N/A';

                                                            $count++;

                                                            echo '
                                                            <tr>
                                                                <td style="font-size: 18px;" class="text-center">' . $count . '</td>
                                                                <td style="font-size: 15px;" class="text-center text-uppercase">
                                                        ' . $title . '
                                                                </td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($description) . '</td>
                                                                <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . htmlspecialchars($full_name) . '</td>
                                                             
                                                            <td class="text-center">
                                                                                <a href="edit-task.php?id=' . $id . '" class="edit-btn">Edit</a>
                                                                                <a href="delete-task.php?id=' . $id . '" class="delete-btn">Delete</a>
                                                                    
                                                            
                                                            </tr>';
                                                        }
                                                        ?>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                    </div>
                </div>

            </section>
        </div>


    </body>

    </html>
<?php
    include "inc/imports.php";
 } else {
    $em = "First login";
    header("Location: login.php?error=$em");
    exit();
}
?>