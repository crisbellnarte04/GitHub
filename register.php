<?php 
session_start();
include "db_connection.php";
include "inc/bootstrap.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - RB Lirio Medical & Diagnostic Clinic</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Times New Roman', serif;
    }

    body {
      background: url("img/bg.jpg") center/cover no-repeat;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      color: white;
    }

    .container {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
    }

    .form-box {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
      border-radius: 15px;
      padding: 30px;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4);
      color: #2f2f2f;
      text-align: center;
    }

    .form-box h2 {
      color: black;
      margin-bottom: 20px;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 28px;
    }

    label {
      display: block;
      text-align: left;
      color: #3b3b3b;
      font-size: 0.9rem;
      margin-bottom: 5px;
    }

    input,
    select {
      width: 100%;
      padding: 8px; /* smaller input height */
      border-radius: 6px;
      border: none;
      outline: none;
      margin-bottom: 12px;
      background: rgba(255, 255, 255, 0.85);
      color: #333;
      font-size: 0.95rem; /* slightly smaller text */
    }

    input:focus,
    select:focus {
      border: 2px solid #0077b6;
    }

    button {
      width: 100%;
      padding: 9px;
      background: rgba(27, 27, 27, 1);
      border-radius: 6px;
      border: none;
      cursor: pointer;
      font-size: 1rem;
      color: #fff;
      font-weight: 500;
      transition: background 0.3s;
    }

    button:hover {
      background: #636465;
    }

    p {
      font-size: 0.9rem;
      text-align: center;
      color: black;
      margin-top: 12px;
    }

    p a {
      color: #333232;
      text-decoration: none;
      font-weight: 600;
    }

    p a:hover {
      text-decoration: underline;
    }

    footer {
      background: rgba(0, 0, 0, 0.7);
      color: white;
      text-align: center;
      padding: 10px 0;
      font-size: 14px;
      margin-top: auto;
      width: 100%;
    }

    @media (max-width: 480px) {
      .form-box {
        padding: 25px 20px;
        width: 90%;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="form-box">
      <h2>Register</h2>
      <form id="signUpform">
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

        <label for="username">Username:</label>
        <input name="username" id="username" type="text" required>

        <label for="pass1">Password:</label>
        <input type="password" id="validationServers01" name="pass1" required placeholder="Enter password" minlength="8" maxlength="21">

        <label for="pass2">Re-enter Password:</label>
        <input type="password" id="validationServers02" name="pass2" required placeholder="Re-enter password" minlength="8" maxlength="21">

        <input type="hidden" name="role" value="user">

        <button type="submit" name="signup">Sign Up</button>
        <p>Already have an account? <a href="login.php">Log In</a></p>
        <p><a href="terms&condition.html">Terms & Condition</a></p>
      </form>
    </div>
  </div>

  <footer>
    <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
  </footer>

  <?php include "inc/imports.php"; ?>
  <script>
    $(document).on('submit', '#signUpform', function(e) {
      e.preventDefault();
      var formData = new FormData(this);
      formData.append("signup", true);
      $.ajax({
        url: "app/registration.php",
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
  </script>
</body>
</html>