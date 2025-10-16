<?php
session_start();
include 'inc/bootstrap.php';

$date = date('Y-m-d');
$user_id = $_SESSION['id'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Services - RB Lirio Medical & Diagnostic Clinic</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
      min-height: 100vh;
    }

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
      flex: 1;
      padding: 40px;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .services {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      padding: 30px 40px;
      border-radius: 10px;
      max-width: 900px;
      width: 100%;
      color: #000;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .services h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 2rem;
      color: #2d2c2c;
    }

    .service-boxes {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    .service {
      background: rgba(255, 255, 255, 0.5);
      padding: 20px;
      border-radius: 10px;
      width: 250px;
      text-align: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
    }

    .service h3 {
      margin-bottom: 10px;
    }

    footer {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 10px 0;
      width: 100%;
      font-size: 14px;
    }

    .btn-dark {
      background-color: #2c2c2c;
      border: none;
    }

    .modal-content {
      background: rgba(255, 255, 255, 0.95);
      border-radius: 10px;
    }
  </style>
</head>
<body>

<header>
  <nav>
    <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
    <ul class="nav-links">
      <li><a href="index.php">Home</a></li>
      <li><a href="user_appointment.php">My Appointment</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="services.php" class="active">Services</a></li>
      <li><a href="packages.php">Packages</a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <section class="services">
    <div class="d-flex justify-content-end mb-3">
      <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#bookNow">Book Now!</button>
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
</div>

<!-- Modal -->
<div class="modal fade" id="bookNow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="bookingForm" class="row g-3 p-4">
        <div class="modal-header">
          <h5 class="modal-title">Book an Appointment</h5>
        </div>
        <div class="modal-body row g-3">
          <!-- Form Fields -->
          <div class="col-md-6">
            <label for="first" class="form-label">First Name</label>
            <input name="first" class="form-control" id="first" type="text" required>
          </div>
          <div class="col-md-6">
            <label for="middle" class="form-label">Middle Name</label>
            <input name="middle" class="form-control" id="middle" type="text">
          </div>
          <div class="col-md-6">
            <label for="last" class="form-label">Last Name</label>
            <input name="last" class="form-control" id="last" type="text" required>
          </div>
          <div class="col-md-6">
            <label for="suffix" class="form-label">Suffix</label>
            <select class="form-select" name="suffix" id="suffix">
              <option selected disabled>Select Suffix</option>
              <option value="Jr.">Jr.</option>
              <option value="Sr.">Sr.</option>
              <option value="I">I</option>
              <option value="II">II</option>
              <option value="III">III</option>
              <option value="IV">IV</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required class="form-control">
          </div>
          <div class="col-md-6">
            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" name="phone" required class="form-control">
          </div>
          <div class="col-md-4">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required class="form-select">
              <option value="">-- Select Gender --</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="date">Preferred Date</label>
            <input type="date" id="date" name="date" required min="<?php echo $date; ?>" class="form-control">
          </div>
          <div class="col-md-4">
            <label for="time">Available Time</label>
            <select id="time" name="time" required class="form-select">
              <option value="">Select valid date first</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="serviceSelect">Purpose of Appointment</label>
            <select name="purpose" id="serviceSelect" class="form-select" onchange="updatePrice()">
              <option selected disabled>-- Select a Service --</option>
              <option value="General Consultation - ₱ 800">General Consultation</option>
              <option value="Blood Test - ₱ 1,500">Blood Test</option>
              <option value="Urinalysis - ₱ 200">Urinalysis</option>
              <option value="Blood Pressure Check - ₱ 150">Blood Pressure Check</option>
              <option value="Pregnancy Test - ₱ 400">Pregnancy Test</option>
              <option value="Vaccination/Immunization - ₱ 2,000">Vaccination/Immunization</option>
              <option value="Electrocardiogram (ECG or EKG) - ₱ 800">Electrocardiogram (ECG or EKG)</option>
              <option value="X-ray service - ₱ 300">X-ray service</option>
              <option value="Complete blood count (CBC) - ₱ 600">Complete blood count (CBC)</option>
              <option value="Urine drug test - ₱ 1,000">Urine drug test</option>
              <option value="Fecalysis (stool exam) - ₱ 500">Fecalysis (stool exam)</option>
              <option value="Pap smear - ₱ 1,200">Pap smear</option>
              <option value="HIV or STD testing - ₱ 1,500">HIV or STD testing</option>
              <option value="Lipid profile test - ₱ 1,200">Lipid profile test</option>
              <option value="Thyroid function test - ₱ 1,500">Thyroid function test</option>
            </select>
          </div>
          <div class="col-md-6">
            <label for="priceInput">Price (₱)</label>
            <input type="text" id="priceInput" placeholder="₱ 0.00" disabled class="form-control">
          </div>
          <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save Appointment</button>
        </div>
      </form>
    </div>
  </div>
</div>

<footer>
  <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
</footer>

<!-- JS Dependencies -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Form submission
  $(document).on('submit', '#bookingForm', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    formData.append("appoint", true);
    $.ajax({
      url: "app/appointment.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(data) {
        const res = JSON.parse(data);
        if (res.status == 401) {
          Swal.fire({ icon: 'warning', title: 'Oops', text: res.msg });
        } else if (res.status == 201) {
          Swal.fire({ icon: 'success', title: 'Booked!', text: res.msg }).then(() => {
            location.reload();
          });
        }
      }
    });
  });

  // Date handling
  const dateInput = document.getElementById('date');
  const timeSelect = document.getElementById('time');

  function populateTimes() {
    timeSelect.innerHTML = '';
    for (let hour = 7; hour <= 17; hour++) {
      const ampm = hour >= 12 ? 'PM' : 'AM';
      const displayHour = hour % 12 === 0 ? 12 : hour % 12;
      const option = document.createElement('option');
      option.value = `${hour}:00`;
      option.textContent = `${displayHour}:00 ${ampm}`;
      timeSelect.appendChild(option);
    }
  }

  dateInput.addEventListener('input', function () {
    const selectedDate = new Date(this.value);
    if (selectedDate.getUTCDay() === 0) {
      Swal.fire({
        icon: 'warning',
        title: 'Invalid Date',
        text: 'Sundays are not allowed. Please choose another date.'
      });
      this.value = '';
      timeSelect.innerHTML = '<option value="">Select valid date first</option>';
      timeSelect.disabled = true;
    } else {
      populateTimes();
      timeSelect.disabled = false;
    }
  });

  function updatePrice() {
    const select = document.getElementById('serviceSelect');
    const priceInput = document.getElementById('priceInput');
    const match = select.value.match(/₱\s?([\d,]+)/);
    priceInput.value = match ? `₱ ${match[1]}` : "";
  }
</script>

</body>
</html>
