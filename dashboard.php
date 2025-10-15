<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Medical Clinic - Content Overview</title>
  <link rel="stylesheet" href="overview.css">
  <style>
body {
      background: none;
    }

    .overview {
      max-width: 1000px;
      width: 90%;
      background: transparent; /* transparent background */
      border-radius: 20px;
      box-shadow: none; /* remove shadow if you want full transparency */
      padding: 40px 50px;
      text-align: center;
    }

    .overview h1 {
      font-size: 2rem;
      color: #0077b6;
      margin-bottom: 10px;
    }

    .overview h2 {
      color: #0096c7;
      margin-bottom: 40px;
      font-weight: 500;
    }

    .overview-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
    }

    .card {
      background: rgba(255, 255, 255, 0.1 ); /* slight transparency for readability */
      border-radius: 16px;
      padding: 25px 20px;
      text-align: center;
      transition: all 0.3s ease;
      border: 2px solid rgba(0, 150, 199, 0.2);
      backdrop-filter: blur(10px); /* optional: adds glass-like effect */
    }

    .card:hover {
      transform: translateY(-5px);
      border-color: #0096c7;
      background: rgba(255, 255, 255, 0.25);
    }

    .icon {
      font-size: 2rem;
      color: #0077b6;
      margin-bottom: 15px;
    }

    h3 {
      color: #023e8a;
      margin-bottom: 10px;
    }

    p {
      color: #fff; /* white text for better visibility on transparent background */
      font-size: 0.95rem;
    }
  </style>
</head>
<body>
 
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

</body>
</html>