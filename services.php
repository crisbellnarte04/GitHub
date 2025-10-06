<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services - RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="css/rblirio.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php" class="active">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="services">
    <h2>Our Services</h2>
    <div class="service-boxes">
      <div class="service">
        <h3>Consultation</h3>
        <p>Professional medical consultations from trusted doctors.</p>
      </div>
      <div class="service">
        <h3>Laboratory</h3>
        <p>Accurate and fast lab test results.</p>
      </div>
      <div class="service">
        <h3>Diagnostics</h3>
        <p>Modern equipment for precise diagnostic results.</p>
      </div>
    </div>
  </section>

  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>