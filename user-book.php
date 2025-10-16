<?php
session_start();
include "db_connection.php";
include "inc/bootstrap.php";

$time = strtotime("+5 days", time());
$date = date("Y-m-d", $time);
$user_id = $_SESSION["id"];

// AJAX availability fetch
if (isset($_GET['doctor_id'])) {
  $doctor_id = $_GET['doctor_id'];
  $stmt = $conn->prepare("SELECT * FROM doctor_availability WHERE doctor_id = ?");
  $stmt->execute([$doctor_id]);
  $availability = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($availability);
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Book Appointment | RB Lirio Medical & Diagnostic Clinic</title>
  

  <style>
    body {
  font-family: 'Times New Roman', sans-serif;
  background: url('img/bg.jpg') center no-repeat;
  background-size: auto; /* keeps original size */
  background-attachment: fixed; /* keeps image steady when scrolling (optional) */
  margin: 0;
  padding: 0;
  color: #fff;
}


    /* ===== Navbar ===== */
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
      color: #fff;
      font-size: 20px;
      font-weight: 600;
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

    /* ===== Container ===== */
    .container {
      background: rgba(255, 255, 255, 0.2);
      backdrop-filter: blur(12px);
      border-radius: 15px;
      border: 1px solid rgba(255, 255, 255, 0.3);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
      max-width: 900px;
      margin: 150px auto 60px;
      padding: 40px 30px;
      color: #fff;
    }

    h2 {
      text-align: center;
      color: black;
      margin-bottom: 30px;
      font-size: 1.8rem;
    }

    /* ===== Form Elements ===== */
    label {
      font-weight: 600;
      color: black;
      margin-bottom: 5px;
      display: block;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.9);
      font-size: 1rem;
    }

    input:focus,
    select:focus {
      outline: 2px solid #00bcd4;
    }

    /* ===== Buttons ===== */
    .btn {
      display: inline-block;
      width: 48%;
      padding: 12px;
      background: #00bcd4;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 1rem;
      font-weight: 500;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #019aad;
    }

    .btn-secondary {
      background: gray;
    }

    .btn-secondary:hover {
      background: #555;
    }

    .card-footer {
      display: flex;
      justify-content: space-between;
      gap: 10px;
      margin-top: 20px;
    }

    /* ===== Footer ===== */
    footer {
      background: rgba(0, 0, 0, 0.6);
      color: #fff;
      text-align: center;
      padding: 15px 0;
      position: relative;
      bottom: 0;
      width: 100%;
      margin-top: 40px;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        gap: 10px;
      }

      .nav-links {
        flex-wrap: wrap;
        justify-content: center;
      }

      .btn {
        width: 100%;
      }

      .card-footer {
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <!-- ===== Navbar ===== -->
  <header>
    <nav>
      <div class="logo">RB Lirio Medical & Diagnostic Clinic</div>
      <ul class="nav-links">
        <li><a href="mainpage.php">Home</a></li>
        <li><a href="user-book.php" class="active">Book Appointment</a></li>
        <li><a href="user_appointment.php">My Appointment</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <!-- ===== Booking Form ===== -->
  <div class="container">
    <h2>Book an Appointment</h2>

    <form id="bookingForm">
      <div class="row">
        <label for="first">First Name:</label>
        <input name="first" id="first" type="text" required>

        <label for="middle">Middle Name:</label>
        <input name="middle" id="middle" type="text">

        <label for="last">Last Name:</label>
        <input name="last" id="last" type="text" required>

        <label for="suffix">Suffix:</label>
        <select name="suffix">
          <option selected disabled>Select Suffix</option>
          <option value="Jr.">Jr.</option>
          <option value="Sr.">Sr.</option>
          <option value="I">I</option>
          <option value="II">II</option>
          <option value="III">III</option>
          <option value="IV">IV</option>
        </select>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
          <option value="">-- Select Gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

        <label for="date">Preferred Date:</label>
        <input type="date" id="date" name="date" required min="<?php echo $date; ?>">

        <label for="time">Available Time:</label>
        <select id="time" name="time" required>
          <option value="">Select valid date first</option>
        </select>

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

        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">

        <div class="card-footer">
          <button type="submit" class="btn">Submit Appointment</button>
          <a href="mainpage.php" class="btn btn-secondary">Close</a>
        </div>
      </div>
    </form>
  </div>

  <!-- ===== Footer ===== -->
  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>

  <?php include 'inc/imports.php'; ?>

  <script>
    // Appointment Form AJAX
    $(document).on('submit', '#bookingForm', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("appoint", true);

      $.ajax({
        url: "app/appointment.php",
        type: "post",
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          var res = jQuery.parseJSON(data);
          if (res.status == 401) {
            Swal.fire({
              icon: 'warning',
              title: 'Something Went Wrong.',
              text: res.msg,
              timer: 10000
            });
          } else if (res.status == 201) {
            Swal.fire({
              icon: 'success',
              title: 'SUCCESS',
              text: res.msg,
              timer: 2000
            }).then(function() {
              location.reload();
            });
          }
        }
      });
    });

    // Time slot generation
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

    dateInput.addEventListener('input', function() {
      const selectedDate = new Date(this.value);
      const day = selectedDate.getUTCDay();
      if (day === 0) {
        alert('Sundays are not allowed. Please choose another date.');
        this.value = '';
        timeSelect.innerHTML = '<option value="">Select valid date first</option>';
        timeSelect.disabled = true;
      } else {
        populateTimes();
        timeSelect.disabled = false;
      }
    });
  </script>
</body>
</html>
