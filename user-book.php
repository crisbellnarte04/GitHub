<?php
include "db_connection.php";
include "inc/bootstrap.php";

// This block is used ONLY if called with AJAX to get availability JSON.
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
  <title>Appointment | RB Lirio Medical & Diagnostic Clinic</title>
  <link rel="stylesheet" href="css/rblirio.css" />
  <style>
    /* Minimal styling for demonstration */
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
      background: #f9f9f9;
    }

    .container {
      max-width: 900px;
      margin: 0 auto;
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: 600;
    }

    input,
    select {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    button.btn {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #0077b6;
      border: none;
      border-radius: 6px;
      color: white;
      font-size: 1.1rem;
      cursor: pointer;
    }

    button.btn:hover {
      background: #005f86;
    }
  </style>
</head>

<body>
  <div class="container">
    <h2>Book an Appointment</h2>
    <form action="submit_appointment.php" method="POST" id="bookingForm" class="row g-3">
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
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

      </div>
      <div class="col-md-6">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required />

      </div>
      <div class="col-md-6">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
          <option value="">-- Select Gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>

      <div class="col-md-6">
        <label for="doctor_id">Select Doctor</label>
        <select id="doctor_id" name="doctor_id" required>
          <option value="">-- Select Doctor --</option>
          <?php
          $stmt = $conn->query("SELECT id, full_name FROM doctors");
          while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='" . htmlspecialchars($row['id']) . "'>" . htmlspecialchars($row['full_name']) . "</option>";
          }
          ?>
        </select>
      </div>

      <div class="col-md-6">
        <label for="date_of_visit">Preferred Date</label>
        <input type="date" id="date_of_visit" name="date_of_visit" required />

      </div>
      <div class="col-md-6">
        <label for="time_of_visit">Available Time</label>
        <select id="time_select" name="time_of_visit" required>
          <option value="">Select valid date first</option>
        </select>
      </div>

      <button type="submit" class="btn">Submit Appointment</button>
    </form>
  </div>

  <!-- jQuery for AJAX -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(function() {
      let availability = [];

      // When doctor changes, fetch availability
      $('#doctor_id').on('change', function() {
        const doctorId = $(this).val();
        if (!doctorId) {
          availability = [];
          $('#time_select').html('<option value="">Select valid date first</option>');
          return;
        }
        $.get('<?= basename(__FILE__) ?>', {
          doctor_id: doctorId
        }, function(data) {
          availability = data;
          $('#date_of_visit').val('');
          $('#time_select').html('<option value="">Select valid date first</option>');
        });
      });

      // When date changes, check availability and generate slots
      $('#date_of_visit').on('change', function() {
        const dateVal = $(this).val();
        if (!dateVal) {
          $('#time_select').html('<option value="">Select valid date first</option>');
          return;
        }

        const selectedDate = new Date(dateVal);
        const selectedDay = selectedDate.getDay(); // Sunday=0

        // Map day names to numbers
        const dayMap = {
          "Sunday": 0,
          "Monday": 1,
          "Tuesday": 2,
          "Wednesday": 3,
          "Thursday": 4,
          "Friday": 5,
          "Saturday": 6
        };

        // Find availability matching the day
        const matchedAvail = availability.find(avail => dayMap[avail.day_of_week] === selectedDay);

        if (!matchedAvail) {
          alert("Doctor is not available on the selected day.");
          $('#date_of_visit').val('');
          $('#time_select').html('<option value="">Select valid date first</option>');
          return;
        }

        // Generate time slots
        const start = matchedAvail.start_time;
        const end = matchedAvail.end_time;
        const duration = parseInt(matchedAvail.slot_duration_minutes, 10);

        const slots = generateTimeSlots(start, end, duration);
        let options = '<option value="">-- Select Time --</option>';
        slots.forEach(slot => {
          options += `<option value="${slot}">${slot}</option>`;
        });

        $('#time_select').html(options);
      });

      function generateTimeSlots(start, end, duration) {
        const slots = [];
        let [startH, startM] = start.split(':').map(Number);
        let [endH, endM] = end.split(':').map(Number);

        let current = new Date();
        current.setHours(startH, startM, 0, 0);

        const endTime = new Date();
        endTime.setHours(endH, endM, 0, 0);

        while (current < endTime) {
          const h = current.getHours().toString().padStart(2, '0');
          const m = current.getMinutes().toString().padStart(2, '0');
          slots.push(`${h}:${m}`);
          current.setMinutes(current.getMinutes() + duration);
        }
        return slots;
      }
    });
  </script>
</body>

</html>