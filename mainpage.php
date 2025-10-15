  <?php 
  session_start();
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RB Lirio Medical & Diagnostic Clinic- Home</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Times New Roman', serif;
      }

      body {
        background: url("img/bg.jpg") center/cover no-repeat;
        color: #fff;
        display: flex;
        flex-direction: column;
        min-height: 100vh;
      }

      /* ===== NAVIGATION BAR ===== */
      header nav {
        background: rgba(0, 0, 0, 0.65);
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

      /* ===== MAIN CONTAINER ===== */
      .container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
      }

      .content-box {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 40px;
        max-width: 900px;
        width: 90%;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
      }

      .content-box h2 {
        font-size: 2.2rem;
        margin-bottom: 20px;
        color: #fff;
        text-transform: uppercase;
        letter-spacing: 1px;
      }

      .overview {
  background: rgba(255, 255, 255, 0.15);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  padding: 40px 50px;
  border-radius: 20px;
  max-width: 900px;
  width: 100%;
  color: #fff;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
  text-align: center;
  margin: auto; /* Centers within flex container */
}

  .overview h1 {
    font-size: 2rem;
    color: #ffffff;
    margin-bottom: 10px;
  }

  .overview h2 {
    color: black;
    margin-bottom: 40px;
    font-weight: 500;
  }

  .overview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap: 20px;
  }

  .card {
    background: rgba(255, 255, 255, 0.2); /* Transparent card background */
    border-radius: 16px;
    padding: 25px 20px;
    text-align: center;
    transition: all 0.3s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    color: #fff;
  }

  .card:hover {
    transform: translateY(-5px);
    border-color: #0096c7;
    background: rgba(255, 255, 255, 0.3);
  }

  .icon {
    font-size: 2rem;
    color: #90e0ef;
    margin-bottom: 15px;
  }

  h3 {
    color:  #2d2c2cff;
    margin-bottom: 10px;
  }

  p {
    color:#2d2c2cff;
    font-size: 0.95rem;
  }

  footer p {
    color: white;
    font-size: 0.95rem;
  }

      /* ===== FOOTER ===== */
      footer {
        background: rgba(0, 0, 0, 0.7);
        color: #eee;
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

        .content-box {
          padding: 25px 20px;
          width: 95%;
        }

        .content-box h2 {
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

        .overview-grid {
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
          <li><a href="services.php">Services</a></li>
          <li><a href="packages.php">Packages</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
  </header>
  <section class="hero">
    
    <section class="overview">
      <h2>RB Lirio Medical Clinic System</h2>

      <div class="overview-grid">

        <div class="card">
          <div class="icon">🏥</div>
          <h3>Clinic Overview</h3>
          <p>Summary of clinic services, departments, and facilities.</p>
        </div>

        <div class="card">
          <div class="icon">👩‍⚕️</div>
          <h3>Doctor Profiles</h3>
          <p>Information about doctors, specialties, and schedules.</p>
        </div>

        <div class="card">
          <div class="icon">📅</div>
          <h3>Appointment Management</h3>
          <p>Scheduling, cancellations, and upcoming appointments.</p>
        </div>

        <div class="card">
          <div class="icon">💊</div>
          <h3>Health Packages & Services</h3>
          <p>Available screening packages, tests, and wellness offers.</p>
        </div>

        <div class="card">
          <div class="icon">💬</div>
          <h3>Feedback & Ratings</h3>
          <p>Patient satisfaction and suggestions for improvement.</p>
        </div>

        <div class="card">
          <div class="icon">🔒</div>
          <h3>User & Access Management</h3>
          <p>Admin, doctor, and patient access controls.</p>
        </div>

      </div>
    </section>

  </section>
    <!-- Footer -->
    <footer>
      <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
    </footer>
  </body>
  </html>