<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us - RB Lirio Medical & Diagnostic Clinic</title>
  
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
      min-height: 100vh; /* ensures footer stays at bottom */
    }

    header nav {
      background: rgba(0, 0, 0, 0.6);
      padding: 10px 0;
      color: white;
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
      flex: 1; /* pushes footer down */
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 40px;
    }

    .about {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      padding: 30px 40px;
      border-radius: 10px;
      max-width: 700px;
      color: #fff;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .about h2 {
      margin-bottom: 15px;
      font-size: 2rem;
      color: #2d2c2cff;
    }
    p {
      color: #2d2c2cff;
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
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="mainpage.php">Home</a></li>
        <li><a href="user_appointment.php">My Appointment</a></li>

        <li><a href="about.php" class="active">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>
<div class ="container">
  <section class="about">
    <h2>About Us</h2>
    <p>RB Lirio Medical & Diagnostic Clinic offers comprehensive medical services and laboratory diagnostics. 
       We are committed to providing reliable healthcare for you and your family.</p>
  </section>
</div>
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>