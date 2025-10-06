<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
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
            background: linear-gradient(to right, #e3e3e3, #c9d6ff);
            color: #333;
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: none;
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
    </style>
</head>
<body>
    <div class ="container">
        <div class ="form-box active" id ="login-from">
            <form action ="login_connection.php" method="POST">
                <h3>Log In</h3>
                <input type ="email" name="email" placeholder ="Email" required><br>
                <input type ="password" name="password" placeholder ="Password" required><br>
                <button type="submit" name="login">Log In</button>
                <p>Don't have an account? <a href="register.php">Register</a></p>
            </form>
        </div>
    </div>
</body>
</html>