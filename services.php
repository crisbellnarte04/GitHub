<?php
session_start();
include 'inc/bootstrap.php';

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
        <li><a href="mainpage.php">Home</a></li>
        <li><a href="user_appointment.php">My Appointment</a></li>

        <li><a href="about.php">About</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="packages.php">Packages</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>


  <section class="services">
    <div class="d-flex flex-row-reverse"><button class=" btn" data-bs-toggle="modal" data-bs-target="#bookNow">
        Book Now!
      </button></div>
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

  <div class="modal fade" id="bookNow" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bookNow" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Book Now!</h5>
        </div>
        <div class="modal-body">
          <form id="bookingForm" class="row g-3">
            <div class="col-md-6">
              <label for="first" class="form-label text-capitalize">first name:</label>
              <input name="first" class="form-control" id="first" type="text" required>
            </div>
            <div class="col-md-6">
              <label for="middle" class="form-label text-capitalize">Middle name:</label>
              <input name="middle" class="form-control" id="middle" type="text">
            </div>
            <div class="col-md-6">
              <label for="last" class="form-label text-capitalize">last name:</label>
              <input name="last" class="form-control" id="last" type="text" required>
            </div>
            <div class="col-md-6">
              <label for="fname" class="form-label text-capitalize">suffix:</label>
              <select class="form-select" name="suffix">
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
              <input type="email" id="email" name="email" placeholder="Enter your email" required class="form-control" />

            </div>
            <div class="col-md-6">
              <label for="phone">Phone Number</label>
              <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required class="form-control" />

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
              <label for="date_of_visit">Preferred Date</label>
              <input type="date" id="date" name="date" required min="<?php echo $date; ?>" class="form-control" />

            </div>
            <div class="col-md-4">
              <label for="time">Available Time</label>
              <select id="time" name="time" required class="form-select">
                <option value="">Select valid date first</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="phone">Purpose of Appointment</label>
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
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </form>

        </div>

      </div>
    </div>
  </div>
  <?php

  include 'inc/imports.php';
  ?>
  <script>
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
            })
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
    const dateInput = document.getElementById('date');
    const timeSelect = document.getElementById('time');

    // Function to populate available times
    function populateTimes() {
      timeSelect.innerHTML = ''; // Clear previous options
      for (let hour = 7; hour <= 17; hour++) {
        const ampm = hour >= 12 ? 'PM' : 'AM';
        const displayHour = hour % 12 === 0 ? 12 : hour % 12;
        const option = document.createElement('option');
        option.value = `${hour}:00`;
        option.textContent = `${displayHour}:00 ${ampm}`;
        timeSelect.appendChild(option);
      }
    }

    // Listen for date change
    dateInput.addEventListener('input', function() {
      const selectedDate = new Date(this.value);
      const day = selectedDate.getUTCDay(); // Sunday = 0

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

    function updatePrice() {
      const select = document.getElementById('serviceSelect');
      const priceInput = document.getElementById('priceInput');
      const selected = select.value;

      if (selected) {
        // Extract price after "₱ "
        const match = selected.match(/₱\s?([\d,]+)/);
        priceInput.value = match ? `₱ ${match[1]}` : "";
      } else {
        priceInput.value = "";
      }
    }
  </script>
</body>

</html>