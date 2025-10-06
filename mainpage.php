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
</head>
<body>
   <?php if ($_SESSION['role'] === "admin") { ?>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="admin-book.php">Manage Appointment</a></li>
        <li><a href="doctor_avail.php">Doctor Availability</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
      </ul>
    </nav>
  </header>
  <section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
        <h1>Welcome to RB Lirio Medical & Diagnostic Clinic</h1>
        <p>Your health is our priority. Providing quality and affordable healthcare for all.</p>
   </div>
  </section>
 <?php } else { ?>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="user-book.php">Book Appointment</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
 </header>
 <section class="hero">
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Welcome to RB Lirio Medical & Diagnostic Clinic</h1>
    <p>Your health is our priority. Providing quality and affordable healthcare for all.</p>
    <a href="packages.php" class="btn">View Packages</a>
  </div>
</section>
<?php } ?>
  <!-- Footer -->
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>