<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Packages - RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
  <style>
    /* ===== RESET ===== */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', sans-serif;
    }

    body {
      background: url("img/bg.jpg") no-repeat center center/cover;
      min-height: 100vh;
      color: #fff;
      display: flex;
      flex-direction: column;
    }

    /* ===== NAVBAR (same as Main Page) ===== */
    header {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.55);
      backdrop-filter: blur(10px);
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 60px;
      z-index: 1000;
    }

    .logo {
      color: #fff;
      font-weight: 700;
      font-size: 1.2rem;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 25px;
    }

    .nav-links li a {
      text-decoration: none;
      color: #fff;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .nav-links li a:hover,
    .nav-links li a.active {
      color: #00bcd4;
    }

    /* ===== MOBILE NAV ===== */
    @media (max-width: 768px) {
      header {
        flex-direction: column;
        padding: 10px 20px;
      }

      .nav-links {
        flex-direction: column;
        gap: 15px;
        margin-top: 10px;
      }
    }

    /* ===== PAGE CONTENT ===== */
    main {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 120px 20px 60px;
      text-align: center;
    }

    main h2 {
      color: #00bcd4;
      font-size: 2rem;
      margin-bottom: 10px;
    }

    main p {
      color: #2f2f2fff;
      margin-bottom: 40px;
      font-size: 1rem;
    }

    /* ===== PACKAGES ===== */
    .package-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
      width: 100%;
      max-width: 1100px;
    }

    .package {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      padding: 25px 20px;
      width: 280px;
      color: #fff;
      border: 1px solid rgba(255, 255, 255, 0.25);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    }

    .package:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 18px rgba(0,0,0,0.4);
    }

    .package h3 {
      font-size: 1.2rem;
      color: #00bcd4;
      margin-bottom: 10px;
    }

    .package ul {
      list-style: none;
      margin-bottom: 20px;
      text-align: left;
      font-size: 0.9rem;
      line-height: 1.6;
    }

    .package ul li {
      color: #2f2f2fff;
    }

    .price {
      font-size: 1.4rem;
      font-weight: 600;
      margin-bottom: 5px;
    }
     
    .free {
      color: #2f2f2fff;
      font-size: 0.95rem;
      margin-bottom: 15px;
    }

    .btn-book {
      display: inline-block;
      background: #00bcd4;
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: 500;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-book:hover {
      background: #009bb0;
      transform: scale(1.05);
    }
    

    /* ===== FOOTER ===== */
    footer {
      text-align: center;
      background: rgba(0, 0, 0, 0.65);
      padding: 15px;
      font-size: 0.9rem;
    }

    @media (max-width: 768px) {
      .package-container {
        flex-direction: column;
        align-items: center;
      }

      .package {
        width: 90%;
      }

      main h2 {
        font-size: 1.6rem;
      }
    }
    /* ===== HEART ICON ANIMATION ===== */
.fa-heart-pulse {
  color: #ff4b5c;
  animation: heartbeat 1.5s infinite;
  transform-origin: center;
}

/* Keyframes for the pulsing effect */
@keyframes heartbeat {
  0% {
    transform: scale(1);
  }
  25% {
    transform: scale(1.2);
  }
  40% {
    transform: scale(1);
  }
  60% {
    transform: scale(1.3);
  }
  100% {
    transform: scale(1);
  }
}


  </style>
</head>
<body>
  <!-- ===== NAVBAR ===== -->
  <header>
    <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
    <ul class="nav-links">
      <li><a href="mainpage.php">Home</a></li>
      <li><a href="user_appointment.php">My Appointment</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="services.php">Services</a></li>
      <li><a href="packages.php" class="active">Packages</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </header>

  <!-- ===== CONTENT ===== -->
  <main>
    <h2>Health Screening Packages</h2>
    <p>Choose from our affordable and comprehensive health screening bundles.</p>

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
        </ul><br>
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
  </main>

  <!-- ===== FOOTER ===== -->
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>
</body>
</html>
