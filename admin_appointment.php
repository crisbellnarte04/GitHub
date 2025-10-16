<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
  include "db_connection.php";
  include "app/Model/Task.php";
  include "app/Model/User.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Appointments - RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', serif;
    }

    body {
      background: url('img/bg.jpg') no-repeat center center/cover;
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
      flex-wrap: wrap;
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

    /* Container */
    .container {
      flex: 1;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      padding: 40px 20px;
      flex-wrap: wrap;
      gap: 20px;
    }

    /* Nav + content side by side on bigger screens */
    <?php /* If inc/nav.php uses something with class .nav-sidebar or similar, else adjust as needed */ ?>

    .content-box {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      padding: 30px 40px;
      border-radius: 10px;
      width: 100%;
      max-width: 1000px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      color: #2d2c2c;
      overflow-x: auto;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.8rem;
      color: #2d2c2c;
    }

    /* Tabs container */
    .tabs {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-bottom: 20px;
    }

    /* Tab buttons */
    .tab-btn {
      background: rgba(0, 0, 0, 0.05);
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 0.5em 1.2em;
      cursor: pointer;
      transition: background 0.3s;
      font-weight: bold;
      font-size: 1rem;
      white-space: nowrap;
      min-width: 120px;
      text-align: center;
      flex: 1 1 auto;
      max-width: 200px;
    }

    .tab-btn:hover,
    .tab-btn.active {
      background: #4CAF50;
      color: white;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      background: white;
      min-width: 700px; /* prevent too much shrinking */
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
    }

    th {
      background: #f2f2f2;
      font-weight: bold;
    }

    tr:hover {
      background: #f9f9f9;
    }

    /* Status badges */
    .badge {
      border-radius: 8px;
      padding: 5px 10px;
      color: white;
      font-size: 0.9rem;
      display: inline-block;
      min-width: 70px;
    }

    .bg-warning { background: #ffc107; color: black; }
    .bg-primary { background: #007bff; }
    .bg-success { background: #28a745; }
    .bg-secondary { background: #6c757d; }

    /* Edit button */
    .edit-btn {
      background: #4CAF50;
      border: none;
      padding: 0.5em 1em;
      border-radius: 5px;
      color: white;
      cursor: pointer;
      transition: background 0.3s ease;
      text-decoration: none;
      font-size: 1rem;
      white-space: nowrap;
      min-width: 120px;
      display: inline-block;
      text-align: center;
      flex-shrink: 0;
    }

    .edit-btn:hover {
      background: #45a049;
    }

    footer {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 10px 0;
      width: 100%;
      font-size: 14px;
    }

    /* Responsive styles */
    @media (max-width: 900px) {
      .content-box {
        padding: 20px 25px;
      }
      table {
        min-width: 600px;
      }
    }

    @media (max-width: 700px) {
      .tabs {
        flex-direction: column;
        align-items: stretch;
      }

      .tab-btn {
        max-width: 100%;
        width: 100%;
        min-width: auto;
        margin-bottom: 10px;
      }

      .edit-btn {
        width: 100%;
        min-width: auto;
        font-size: 1.1rem;
        margin-top: 5px;
      }

      table {
        min-width: 100%;
        font-size: 0.9rem;
      }

      th, td {
        padding: 8px 5px;
      }

      /* Allow container padding */
      .container {
        padding: 20px 15px;
        flex-direction: column;
        align-items: center;
      }
    }
  </style>
</head>
<body>
  <?php include "inc/header.php"; ?>

  <div class="container">
    <?php include "inc/nav.php"; ?>

    <div class="content-box">
      <h2>Manage Appointments</h2>

      <div class="tabs">
        <button class="tab-btn active">All (<?= $all_appoint ?? 0; ?>)</button>
        <button class="tab-btn">Pending (<?= $pending ?? 0; ?>)</button>
        <button class="tab-btn">Accepted (<?= $accept ?? 0; ?>)</button>
        <button class="tab-btn">Completed (<?= $completed ?? 0; ?>)</button>
      </div>

      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Purpose</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Submitted</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $count = 0;
          $stmt = $conn->prepare("SELECT * FROM appointments");
          $stmt->execute();
          $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

          foreach ($appointments as $row) {
            $count++;
            $full_name = htmlspecialchars($row['lname'] . ', ' . $row['fname']);
            $status = $row['stat'];
            switch ($status) {
              case 'pending': $badgeClass = 'bg-warning'; break;
              case 'accept': $badgeClass = 'bg-primary'; break;
              case 'completed': $badgeClass = 'bg-success'; break;
              default: $badgeClass = 'bg-secondary';
            }

            echo "
            <tr>
              <td>{$count}</td>
              <td>{$full_name}</td>
              <td>" . htmlspecialchars($row['purpose']) . "</td>
              <td>" . htmlspecialchars($row['date']) . "</td>
              <td>" . htmlspecialchars($row['time']) . "</td>
              <td><span class='badge {$badgeClass}'>" . htmlspecialchars($status) . "</span></td>
              <td>" . htmlspecialchars($row['created']) . "</td>
              <td>";
                if ($status == 'pending') {
                  echo "<button class='edit-btn' data-bs-toggle='modal' data-bs-target='#assignedDoctor{$row['b_id']}'>Assign Doctor</button>";
                } else {
                  echo "-";
                }
            echo "</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>
<?php 
} else { 
  $em = "First login";
  header("Location: login.php?error=$em");
  exit();
}
?>
