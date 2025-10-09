<?php
session_start();
include 'db_connection.php';
include 'inc/bootstrap.php';
$user_id = $_SESSION["id"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="css/rblirio.css">
  <style>

  </style>
</head>

<body>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="mainpage.php">Home</a></li>
        <li><a href="user_appointment.php" class="active">My Appointment</a></li>
        <li><a href="about.php" >About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <section class="about">
      <div class="table-responsive">
        <table class="table table-striped table-bordered first">
          <thead class="bg-light">
            <tr class="border-0">
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;"></th>
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">PURPOSE</th>
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">PREFER DATE</th>
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">PREFER TIME</th>
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ASSIGNED DOCTOR</th>
              <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">STATUS</th>
              <!-- <th class="border-0 text-center font-weight-bold" style="font-size: 16px; font-family: head;">ACTION</th> -->
            </tr>
          </thead>
          <tbody>
            <?php
            $count = '0';
            $fetch_appointment = "SELECT * FROM `appointments` where `user_id` = '$user_id' ";
            $result = mysqli_query($sqli, $fetch_appointment);
            while ($row = mysqli_fetch_assoc($result)) {
              $b_id = $row['b_id'];
              $stat = $row['stat'];
              $purpose = $row['purpose'];
              $date = $row['date'];
              $time = $row['time'];
              if ($stat == 'pending') {
                $doc_name = 'not yet assigned';
              } else {
                $d_id = $row['d_id'];

                $fetch_doc = "SELECT * FROM `users` where `id` = '$d_id' ";
                $doc_res = mysqli_query($sqli, $fetch_doc);
                $doc = mysqli_fetch_assoc($doc_res);
                $doc_name = $doc['full_name'];
              }
              switch ($stat) {
                case 'pending':
                  $badgeClass = 'bg-warning';

                  break;

                case 'accept':
                  $badgeClass = 'bg-primary';

                  break;

                case 'completed':
                  $badgeClass = 'bg-success';
                  break;

                default:
              }
              $count++;


              echo '<tr>
                                                              <td style="font-size: 18px;" class="text-center">
                                                                ' . $count . '
                                                            </td>
                                                       
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . $purpose . '</td>
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . $date . '</td>
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . $time . '</td>
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">' . $doc_name . '</td>
                                                            <td style="font-size: 18px; text-transform:lowercase;" class="text-center">
                                                                 <span class="badge rounded-pill text-bg     ' . $badgeClass . ' p-2 text-capitalize" style="letter-spacing:1px; font-size:13px;">' . $stat . '</span>
                                                            </td>
                                                     
                                                          
                                                        </tr>';
            }
            ?>

          </tbody>
        </table>
      </div>
    </section>
  </div>
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>

</html>