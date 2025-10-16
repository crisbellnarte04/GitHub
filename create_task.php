<?php
session_start();
if (isset($_SESSION['role']) && isset($_SESSION['id']) && $_SESSION['role'] == "admin") {
	include "db_connection.php";
	include "app/Model/User.php";
	$today = date('Y-m-d');
	$users = get_all_users($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Task - RB Lirio Medical & Diagnostic Clinic</title>
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
      max-width: 550px;
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

    input[type="text"], 
    input[type="date"],
    textarea,
    select {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
      resize: none;
    }

    textarea {
      height: 80px;
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
      <h2>Create Task</h2>

      <?php if (isset($_GET['error'])) { ?>
        <div class="danger"><?php echo stripcslashes($_GET['error']); ?></div>
      <?php } ?>

      <?php if (isset($_GET['success'])) { ?>
        <div class="success"><?php echo stripcslashes($_GET['success']); ?></div>
      <?php } ?>

      <form method="POST" action="app/add-task.php">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="title" placeholder="Enter task title" required>
        </div>

        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="description" name="description" placeholder="Enter task description" required></textarea>
        </div>

        <div class="form-group">
          <label for="due_date">Due Date</label>
          <input type="date" id="due_date" name="due_date" min="<?php echo $today; ?>" required>
        </div>

        <div class="form-group">
          <label for="assigned_to">Assign To</label>
          <select name="assigned_to" id="assigned_to" required>
            <option value="">Select employee</option>
            <?php 
            if ($users != 0) {
              foreach ($users as $user) { ?>
                <option value="<?= $user['id'] ?>"><?= $user['full_name'] ?></option>
            <?php } } ?>
          </select>
        </div>

        <button type="submit">Create Task</button>
      </form>

      <a href="manage_tasks.php" class="back-link">← Back to Task List</a>
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