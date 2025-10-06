<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Packages - RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="css/rblirio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php" class="active">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

 <section id="packages" class="packages">
  <h2>Health Screening Packages</h2>
  <p>Choose from our affordable health screening bundles.</p>

  <div class="package-container">

    <div class="package">
      <h3><i class="fa-solid fa-heart-pulse"></i> Magic 8</h3>
      <ul>
        <li>Fasting Blood Sugar</li>
        <li>Cholesterol</li>
        <li>Blood Uric Acid</li>
        <li>Creatinine</li>
        <li>Blood Urea Nitrogen</li>
        <li>Triglycerides</li>
        <li>HDL</li>
        <li>LDL</li>
      </ul><br>
      <br>
      <br>
      <br>
      <br>
      <p class="price">₱899</p>
      <p class="free">+ FREE CBC & Urinalysis</p>
      <a href="user-book.php" class="btn-book"><i class="fa-solid fa-calendar-check"></i> Book Now</a>
    </div>

    <div class="package">
      <h3><i class="fa-solid fa-heart-pulse"></i> Magic 10</h3>
      <ul>
        <li>Fasting Blood Sugar</li>
        <li>Cholesterol</li>
        <li>Blood Uric Acid</li>
        <li>Creatinine</li>
        <li>Blood Urea Nitrogen</li>
        <li>Triglycerides</li>
        <li>HDL</li>
        <li>LDL</li>
        <li>SGOT</li>
        <li>SGPT</li>
      </ul>
      <br>
      <br>
      <p class="price">₱1099</p>
      <p class="free">+ FREE CBC & Urinalysis</p>
      <a href="user-book.php" class="btn-book"><i class="fa-solid fa-calendar-check"></i> Book Now</a>
    </div>

    <div class="package">
      <h3><i class="fa-solid fa-heart-pulse"></i> Magic 12</h3>
      <ul>
        <li>Fasting Blood Sugar</li>
        <li>Cholesterol</li>
        <li>Blood Uric Acid</li>
        <li>Creatinine</li>
        <li>Blood Urea Nitrogen</li>
        <li>Triglycerides</li>
        <li>HDL</li>
        <li>LDL</li>
        <li>SGOT</li>
        <li>SGPT</li>
        <li>Sodium</li>
        <li>Potassium</li>
      </ul>
      <p class="price">₱1499</p>
      <p class="free">+ FREE CBC & Urinalysis</p>
      <a href="user-book.php" class="btn-book"><i class="fa-solid fa-calendar-check"></i> Book Now</a>
    </div>

  </div>
</section>


  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>