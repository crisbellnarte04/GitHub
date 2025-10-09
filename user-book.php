<?php
session_start();
include "db_connection.php";
include "inc/bootstrap.php";
$time = strtotime("+5 days", time());
$date = date("Y-m-d", $time);
$user_id = $_SESSION["id"];
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
        <input type="email" id="email" name="email" placeholder="Enter your email" required />

      </div>
      <div class="col-md-6">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required />

      </div>
      <div class="col-md-4">
        <label for="gender">Gender</label>
        <select id="gender" name="gender" required>
          <option value="">-- Select Gender --</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>



      <div class="col-md-4">
        <label for="date_of_visit">Preferred Date</label>
        <input type="date" id="date" name="date" required min="<?php echo $date; ?>" />

      </div>
      <div class="col-md-4">
        <label for="time">Available Time</label>
        <select id="time" name="time"  required>
          <option value="">Select valid date first</option>
        </select>
      </div>
      <div class="col-md-12">
        <label for="phone">Purpose of Appointment</label>
        <input type="text" id="purpose" name="purpose" placeholder="Enter your purpose" required />

      </div>
      <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
      <div class="card-footer">
        <button type="submit" class="btn">Submit Appointment</button>
        <a href="mainpage.php" type="button btn-secondary">
          <button type="button" class="btn" style="background-color: gray;">Close</button>

        </a>
      </div>
    </form>
  </div>

  <?php
  include 'inc/imports.php'; ?>

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
  </script>
  <!-- jQuery for AJAX
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
  </script> -->
</body>

</html>