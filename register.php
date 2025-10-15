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
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Times New Roman', serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url("img/bg.jpg") center/cover no-repeat;
            color: black;
        }

        .container {
            margin: 0 15px;
        }

        .form-box {
            width: 100%;
            max-width: 700px;
            padding: 30px;
            background: transparent;
            border-radius: 10px;
        }

        .form-box.active {
            display: block;
        }

        h2 {
            font-size: 34px;
            text-align: center;
            margin-bottom: 20px;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            background: #eee;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 15px;
            color: #333;
            margin-bottom: 20px;
        }

        button {
            width: 100%;
            padding: 12px;
            background: #7494ec;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 16px;
            color: #fff;
            font-weight: 500;
            margin-top: 20px;
            transition: 0.5s;
        }

        button:hover {
            background: #6884d3;
        }

        p {
            font-size: 14.5px;
            text-align: center;
            margin-bottom: 10px;
        }

        p a {
            color: #7494ec;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 10px 0;
            font-size: 14px;
            z-index: 999;
        }
    </style>
</head>

<body>

    <div class="form-box">
        <h2>Register</h2>
        <form class="row g-3" id="signUpform">
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

            <div class="col-md-12">
                <label for="username" class="form-label text-capitalize">username:</label>
                <input name="username" class="form-control" id="username" type="text" required>
            </div>
            <div class="col-md-12">
                <label for="validationServer02" class="form-label">Password<sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" id="validationServers01" name="pass1" required placeholder="Enter the account password " minlength="8" maxlength="21" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <div class="invalid-feedback">
                    Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters
                </div>
            </div>
            <div class="col-md-12">
                <label for="validationServer02" class="form-label">Re-enter Password<sup class="text-danger">*</sup>:</label>
                <input type="text" class="form-control" id="validationServers02" name="pass2" required placeholder="Enter the Unique Password" minlength="8" maxlength="21" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
                <div class="invalid-feedback">

                    Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters
                </div>

            </div>

            <input type="hidden" name="role" value="user">

            <button type="submit" name="signup">Sign Up</button>
            <p>Already have an account?<a href="login.php"> Log In</a></p>
        </form>
    </div>

    <footer>
        <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
    </footer>

</body>
<?php
include "inc/imports.php";
?>
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

    function togglePasswordVisibility1() {
        var passwordInput1 = document.getElementById("validationServers01");
        var showPasswordCheckbox1 = document.getElementById("pass1");

        if (showPasswordCheckbox1.checked) {
            passwordInput1.type = "text";
        } else {
            passwordInput1.type = "password";
        }
    }

    function togglePasswordVisibility2() {
        var passwordInput2 = document.getElementById("validationServers02");
        var showPasswordCheckbox2 = document.getElementById("pass2");

        if (showPasswordCheckbox2.checked) {
            passwordInput2.type = "text";
        } else {
            passwordInput2.type = "password";
        }
    }
</script>

</html>