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
  <title>My Appointments - RB Lirio Medical & Diagnostic Clinic</title>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', serif;
    }

    body {
      background: url("img/bg.jpg") center center / cover no-repeat fixed;
      color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ===== NAVIGATION BAR ===== */
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
      font-size: 1.2rem;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 15px;
      margin-right: 20px;
      flex-wrap: wrap;
      justify-content: flex-end;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s;
      font-size: 1rem;
    }

    .nav-links a:hover,
    .nav-links .active {
      background: rgba(255, 255, 255, 0.2);
    }

    /* ===== MAIN CONTAINER ===== */
    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 60px 20px;
    }

    .content-box {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(12px);
  -webkit-backdrop-filter: blur(12px);
  border-radius: 20px;
  padding: 40px;
  max-width: 1200px; /* increased from 1000px */
  width: 95%; /* slightly wider */
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
  text-align: center;
  overflow-x: auto;
  margin: 0 auto;
}

    .content-box h2 {
      font-size: 2rem;
      color: black;
      margin-bottom: 25px;
      text-align: center;
    }

    /* ===== TABLE ===== */
    table {
  width: 110%; /* slightly wider than container */
  margin: 0 auto;
  border-collapse: collapse;
  color: black;
  text-align: center;
  margin-top: 10px;
}

    th,
    td {
      padding: 14px;
      border: 1px solid rgba(255, 255, 255, 0.3);
    }

    th {
      background: rgba(0, 0, 0, 0.5);
      color: white;
      font-size: 16px;
      letter-spacing: 0.5px;
    }

    td {
      background: rgba(255, 255, 255, 0.1);
      font-size: 15px;
    }

    tr:hover td {
      background: rgba(255, 255, 255, 0.25);
      transition: background 0.3s;
    }

    /* ===== FOOTER ===== */
    footer {
      background: rgba(0, 0, 0, 0.6);
      text-align: center;
      padding: 12px 0;
      color: #fff;
      font-size: 0.9rem;
      margin-top: auto;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .content-box {
        width: 95%;
        padding: 25px;
        max-width: 100%;
      }

      table {
        font-size: 13.5px;
      }

      th,
      td {
        padding: 8px;
      }
    }

    @media (max-width: 480px) {
      .content-box {
        padding: 15px;
      }

      table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
      }
    }
  </style>
</head>

<body>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="user-book.php">Book Appointment</a></li>
        <li><a href="user_appointment.php" class="active">My Appointment</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <div class="container">
    <div class="content-box">
      <h2>My Appointments</h2>
      <div class="table-responsive">
        <table>
          <thead>
            <tr>
              <th>#</th>
              <th>Purpose</th>
              <th>Preferred Date</th>
              <th>Preferred Time</th>
              <th>Assigned Doctor</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $count = 0;
            $fetch_appointment = "SELECT * FROM `appointments` WHERE `user_id` = '$user_id'";
            $result = mysqli_query($sqli, $fetch_appointment);

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                $stat = $row['stat'];
                $purpose = $row['purpose'];
                $date = $row['date'];
                $time = $row['time'];
                $doc_name = 'Not yet assigned';

                if ($stat != 'pending' && !empty($row['d_id'])) {
                  $d_id = $row['d_id'];
                  $fetch_doc = "SELECT full_name FROM `users` WHERE `id` = '$d_id' LIMIT 1";
                  $doc_res = mysqli_query($sqli, $fetch_doc);
                  if ($doc_res && mysqli_num_rows($doc_res) > 0) {
                    $doc = mysqli_fetch_assoc($doc_res);
                    $doc_name = $doc['full_name'] ?? 'Unknown Doctor';
                  }
                }

                echo "<tr>
                        <td>$count</td>
                        <td>$purpose</td>
                        <td>$date</td>
                        <td>$time</td>
                        <td>$doc_name</td>
                        <td><span style='text-transform:capitalize;'>$stat</span></td>
                      </tr>";
              }
            } else {
              echo "<tr><td colspan='6'>No appointments found.</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>
 