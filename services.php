<?php
session_start();
include 'inc/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Services - RB Lirio Medical & Diagnostic Clinic</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', serif;
    }

    body {
      background: url("img/bg.jpg") center/cover no-repeat fixed;
      color: #fff;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ===== NAVIGATION BAR ===== */
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
      font-size: 1.2rem;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 15px;
      margin-right: 20px;
      flex-wrap: wrap;
      justify-content: flex-end;
    }

    .nav-links a {
      color: white;
      text-decoration: none;
      padding: 8px 12px;
      border-radius: 5px;
      transition: background 0.3s;
      font-size: 1rem;
    }

    .nav-links a:hover,
    .nav-links .active {
      background: rgba(255, 255, 255, 0.2);
    }

    /* ===== SERVICES SECTION ===== */
    .services {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      padding: 40px 50px;
      border-radius: 20px;
      max-width: 900px;
      width: 90%;
      color: black;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      text-align: center;
      margin: 60px auto;
    }

    .services h2 {
      margin-bottom: 25px;
      font-size: 2rem;
      color: black;
    }

    .btn {
      background: rgba(37, 37, 37, 1);
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 10px 18px;
      cursor: pointer;
      transition: background 0.3s;
      margin-bottom: 25px;
    }

    .btn:hover {
      background: gray;
    }

    .service-boxes {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 25px;
      justify-content: center;
    }

    .service {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
      transition: transform 0.3s, background 0.3s;
    }

    .service:hover {
      transform: translateY(-5px);
      background: rgba(255, 255, 255, 0.2);
    }

    .service h3 {
      margin-bottom: 10px;
      font-size: 1.3rem;
      color: black;
    }

    .service p {
      font-size: 1rem;
      color: black;
    }

    /* ===== FOOTER ===== */
    footer {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 10px 0;
      width: 100%;
      font-size: 14px;
      margin-top: auto;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 768px) {
      .logo {
        font-size: 1rem;
        margin-left: 15px;
      }

      .nav-links {
        justify-content: center;
        margin: 10px 0;
        gap: 10px;
      }

      .nav-links a {
        font-size: 0.9rem;
        padding: 6px 10px;
      }

      .services {
        padding: 30px 20px;
        width: 95%;
      }

      .services h2 {
        font-size: 1.6rem;
      }

      footer {
        font-size: 12px;
      }
    }

    @media (max-width: 480px) {
      .nav-links {
        flex-direction: column;
        gap: 8px;
      }

      .nav-links a {
        display: block;
        text-align: center;
        width: 100%;
        background: rgba(255, 255, 255, 0.1);
      }

      .service-boxes {
        grid-template-columns: 1fr;
      }
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
        <li><a href="services.php" class="active">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <section class="services">
    <div class="d-flex flex-row-reverse">
      <button class="btn" data-bs-toggle="modal" data-bs-target="#bookNow">Book Now!</button>
    </div>
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

  <!-- Include your modal and JS here -->
  <?php include 'inc/imports.php'; ?>
</body>
</html>
