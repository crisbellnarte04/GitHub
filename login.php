<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - RB Lirio Medical & Diagnostic Clinic</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', serif;
    }

    body {
      background: url("img/bg.jpg") center/cover no-repeat;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: white;
    }

    /* ===== LOGIN CONTAINER ===== */
    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .login-box {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 15px;
      padding: 40px;
      max-width: 400px;
      width: 100%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
      color: #2f2f2fff;
      text-align: center;
    }

    .login-box h2 {
      color: black;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .login-box label {
      display: block;
      text-align: left;
      color: #3b3b3bff;
      font-size: 0.95rem;
      margin-bottom: 5px;
    }

    .login-box input {
      width: 100%;
      padding: 10px;
      border-radius: 6px;
      border: none;
      outline: none;
      margin-bottom: 15px;
      background: rgba(255, 255, 255, 0.85);
      color: #333;
      font-size: 1rem;
    }

    .login-box input:focus {
      border: 2px solid #0077b6;
    }

    .btn {
      background: rgba(27, 27, 27, 1);
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      font-size: 1rem;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #636465ff;
    }

    .login-box p {
      color: black;
      margin-top: 15px;
      font-size: 0.9rem;
    }

    .login-box a {
      color: #333232ff;
      text-decoration: none;
    }

    .login-box a:hover {
      text-decoration: underline;
    }

    /* ===== FOOTER ===== */
    footer {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      margin-top: auto;
      width: 100%;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 480px) {
      .login-box {
        padding: 30px 20px;
        width: 90%;
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="login-box">
      <h2>Login</h2>

      <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger" role="alert" style="background: rgba(255,0,0,0.2); color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
          <?php echo stripcslashes($_GET['error']); ?>
        </div>
      <?php } ?>

      <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success" role="alert" style="background: rgba(0,128,0,0.3); color: white; padding: 10px; border-radius: 5px; margin-bottom: 10px;">
          <?php echo stripcslashes($_GET['success']); ?>
        </div>
      <?php } ?>

      <form method="POST" action="app/login_connection.php">
        <label for="username">User Name</label>
        <input type="text" name="user_name" id="username" placeholder="Username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Password" required>

        <button type="submit" class="btn">Login</button>
      </form>

      <p>Don't have an account? <a href="register.php">Register</a></p>
      <p><a href="terms&condition.html">Terms & Condition</a></p>
    </div>
  </div>

  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>
