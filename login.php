<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login | Task Management System</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<style>
		* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family:'Times New Roman', serif;
        }
        body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: url("img/rblirio.jpg") center/cover no-repeat;
            color: black;
        }
        .container{
            margin: 0 15px;
        }
        .form-box {
            width: 100%;
            max-width: 450px;
            padding: 30px;
            background: #fff;
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
        input, select {
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
<body class="login-body">
      
      <form method="POST" action="app/login_connection.php" class="shadow p-4">

      	  <h3 class="display-4">LOGIN</h3>
      	  <?php if (isset($_GET['error'])) {?>
      	  	<div class="alert alert-danger" role="alert">
			  <?php echo stripcslashes($_GET['error']); ?>
			</div>
      	  <?php } ?>

      	  <?php if (isset($_GET['success'])) {?>
      	  	<div class="alert alert-success" role="alert">
			  <?php echo stripcslashes($_GET['success']); ?>
			</div>
      	  <?php } 

                // $pass = "123";
                // $pass = password_hash($pass, PASSWORD_DEFAULT);
                // echo $pass;
      
      	  ?>
  
			
		  <div class="mb-3">
		    <label for="exampleInputEmail1" class="form-label">User name</label>
		    <input type="text" class="form-control" name="user_name" placeholder="Username">
		  </div>
		  <div class="mb-3">
		    <label for="exampleInputPassword1" class="form-label">Password</label>
		    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Username">
		  </div>
		  <p>Don't have an account? <a href="register.php">Register</a></p>
		  <button type="submit" class="btn btn-primary">Login</button>
		  <p><a href ="terms&condition.html">Terms & Condition</a></p>
		</form>
       <footer>
         <p>© 2025 RB Lirio Medical & Diagnostic Clinic. All Rights Reserved.</p>
       </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>