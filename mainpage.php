<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RB Lirio Medical & Diagnostic Clinic- Home</title>
  <link rel="stylesheet" href="css/rblirio.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .hero {
      background-image: url('img/bg.jpg');
    }
  </style>
</head>
<body>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="user-book.php">Book Appointment</a></li>
        <li><a href="user_appointment.php">My Appointment</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
 </header>
 <section class="hero">
  <?php include "dashboard.php"?>>
</section>
  <!-- Footer -->
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>