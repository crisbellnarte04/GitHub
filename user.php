<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
    include "db_connection.php";
    include "app/Model/User.php";

    $users = get_all_users($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users - RB Lirio Medical & Diagnostic Clinic</title>
  
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

    /* Center container fix */
    .container {
      flex: 1;
      display: flex;
      align-items: center;   /* vertically center */
      justify-content: center; /* horizontally center */
      padding: 40px;
    }

    .content-box {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      padding: 30px 40px;
      border-radius: 10px;
      max-width: 900px;
      width: 100%;
      color: #2d2c2c;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 1.8rem;
      color: #2d2c2c;
    }

    a.add-user-btn {
      display: inline-block;
      margin-bottom: 15px;
      background: #4CAF50;
      color: white;
      text-decoration: none;
      padding: 8px 16px;
      border-radius: 5px;
      transition: background 0.3s;
    }

    a.add-user-btn:hover {
      background: #45a049;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    th, td {
      border: 1px solid #ddd;
      text-align: center;
      padding: 10px;
    }

    th {
      background-color: #2d2c2c;
      color: white;
    }

    tr:nth-child(even) {
      background-color: rgba(0,0,0,0.05);
    }

    .edit-btn, .delete-btn {
      text-decoration: none;
      color: white;
      padding: 5px 10px;
      border-radius: 5px;
    }

    .edit-btn {
      background: #007bff;
    }

    .delete-btn {
      background: #dc3545;
    }

    .edit-btn:hover {
      background: #0056b3;
    }

    .delete-btn:hover {
      background: #c82333;
    }

    .success {
      background: #28a745;
      color: white;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 5px;
      text-align: center;
    }

    h3 {
      text-align: center;
      color: #2d2c2c;
      margin-top: 20px;
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
  <div class="container">
	<?php include "inc/nav.php"; ?>
    <div class="content-box">
      <h2>Manage Users</h2>
      <a href="add-user.php" class="add-user-btn">+ Add User</a>

      <?php if (isset($_GET['success'])) { ?>
        <div class="success"><?php echo stripcslashes($_GET['success']); ?></div>
      <?php } ?>

      <?php if ($users != 0) { ?>
        <table>
          <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
          </tr>
          <?php $i=0; foreach ($users as $user) { ?>
          <tr>
            <td><?= ++$i ?></td>
            <td><?= htmlspecialchars($user['full_name']) ?></td>
            <td><?= htmlspecialchars($user['username']) ?></td>
            <td><?= htmlspecialchars($user['role']) ?></td>
            <td>
              <a href="edit-user.php?id=<?= $user['id'] ?>" class="edit-btn">Edit</a>
              <a href="delete-user.php?id=<?= $user['id'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
            </td>
          </tr>
          <?php } ?>
        </table>
      <?php } else { ?>
        <h3>No users found</h3>
      <?php } ?>
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