<?php 
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add User - RB Lirio Medical & Diagnostic Clinic</title>
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
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }

    .content-box {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      padding: 30px 40px;
      border-radius: 10px;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      color: #2d2c2c;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1.8rem;
      color: #2d2c2c;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #2d2c2c;
    }

    input[type="text"], select {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      border: none;
      color: white;
      font-size: 1rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background-color: #45a049;
    }

    .success {
      background: #28a745;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }

    .danger {
      background: #dc3545;
      color: white;
      padding: 10px;
      border-radius: 5px;
      margin-bottom: 15px;
      text-align: center;
    }

    .back-link {
      display: inline-block;
      margin-top: 15px;
      text-decoration: none;
      color: #007bff;
      text-align: center;
      width: 100%;
    }

    .back-link:hover {
      text-decoration: underline;
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
      <h2>Add User</h2>

      <?php if (isset($_GET['error'])) { ?>
        <div class="danger"><?php echo stripcslashes($_GET['error']); ?></div>
      <?php } ?>

      <?php if (isset($_GET['success'])) { ?>
        <div class="success"><?php echo stripcslashes($_GET['success']); ?></div>
      <?php } ?>

      <form method="POST" action="app/add-user.php">
        <div class="form-group">
          <label for="full_name">Full Name</label>
          <input type="text" id="full_name" name="full_name" placeholder="Full Name" required>
        </div>

        <div class="form-group">
          <label for="user_name">Username</label>
          <input type="text" id="user_name" name="user_name" placeholder="Username" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="text" id="password" name="password" placeholder="Password" required>
        </div>

        <div class="form-group">
          <label for="role">Role</label>
          <select name="role" id="role" required>
            <option selected disabled>Select Role</option>
            <option value="employee">Employee</option>
            <option value="doctor">Doctor</option>
          </select>
        </div>

        <button type="submit">Add</button>
      </form>

      <a href="user.php" class="back-link">← Back to Manage Users</a>
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