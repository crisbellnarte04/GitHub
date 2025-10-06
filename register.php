<?php
session_start();
include "db_connection.php";

// Optional: initialize to avoid PHP notices
$username = $full_name = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:'Times New Roman', serif;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url("img/rblirio.jpg") center/cover no-repeat;
            color: black;
        }
        .container{
            margin: 0 15px;
        }
        .form-box {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            background: transparent;
            border-radius: 10px;
        }
        .form-box.active {
            display: block;
        }
        h2 {
            font-size: 34px;
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            background: #eee;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 15px;
            color: #333;
            margin-bottom: 20px;
        }
        button {
            width: 100%;
            padding: 12px;
            background: #7494ec;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            margin-top: 20px;
            transition: 0.5s;
        }
        button:hover {
            background: #6884d3;
        }
        p {
            font-size: 14.5px;
            text-align: center;
            margin-bottom: 10px;
        }
        p a {
            color: #7494ec;
            text-decoration: none;
        }
        p a:hover {
            text-decoration: underline;
        }
        footer {
             position: fixed;
             bottom: 0;
             left: 0;
             width: 100%;
             background: rgba(0, 0, 0, 0.7);
             color: white;
             text-align: center;
             padding: 10px 0;
             font-size: 14px;
             z-index: 999;
        }
    </style>
</head>
<body>

<div class="form-box">
    <h2>Register</h2>
    <form action="register.php" method="POST">
        <label>Full Name:</label>
        <input type="text" name="full_name" required value="<?= htmlspecialchars($full_name ?? '') ?>">

        <label>Username:</label>
        <input type="text" name="username" required value="<?= htmlspecialchars($username ?? '') ?>">

        <label>Password:</label>
        <input type="password" name="password" required>

        <label>Repeat Password:</label>
        <input type="password" name="confirm_password" required>

        <input type="hidden" name="role" value="user">

        <button type="submit" name="signup">Sign Up</button>
        <p>Already have an account?<a href="login.php"> Log In</a></p>
    </form>
</div>

<footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
</footer>

</body>
</html>
