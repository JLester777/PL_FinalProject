<?php
session_start();
$error = "";
if (isset($_POST['loginbutton'])) {
    $Username = $_POST['uname'];
    $Pass = $_POST['pass'];
    extract($_POST);
    include 'db_connect.php';
    $sql = mysqli_query($conn, "SELECT * FROM admin where Username='$Username' and Pass='$Pass'");
    $row  = mysqli_fetch_array($sql);
    if (is_array($row)) {
        $_SESSION["uname"] = $row['Username'];
        $_SESSION["Pass"] = $row['Pass'];
        mysqli_query($conn, "UPDATE role SET id = 1 where name='role'");
        header("Location: Welcome.php");
    } else {
        $error = "Invalid Username or Password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Police Crime Record Management System - Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }

        body {
            background: linear-gradient(to right, #2c3e50, #3498db);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo {
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .logo img {
            height: 100px;
            cursor: pointer;
        }

        .loginbox {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .loginbox img.avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 20px;
        }

        .loginbox h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #2c3e50;
        }

        .loginbox label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-weight: bold;
            color: #2c3e50;
        }

        .loginbox input[type="text"],
        .loginbox input[type="password"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .loginbox input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            background-color: #3498db;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.3s;
        }

        .loginbox input[type="submit"]:hover {
            background-color: #2980b9;
        }

        .error {
            background-color: #ffdddd;
            color: #c0392b;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 14px;
        }

        @media screen and (max-width: 500px) {
            .loginbox {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

    <!-- Logo Top Left -->
    <a href="Login.php" class="logo">
        <img src="logo.png" alt="Go to Login Page">
    </a>

    <div class="loginbox">
        <img src="avatar.jpg" class="avatar" alt="Admin Avatar">
        <form action="adminlogin.php" method="post">
            <h1>ADMIN LOGIN</h1>

            <?php if ($error != "") { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>

            <label for="username">Username</label>
            <input type="text" name="uname" id="username" placeholder="Enter Username" required>

            <label for="password">Password</label>
            <input type="password" name="pass" id="password" placeholder="Enter Password" required>

            <input type="submit" name="loginbutton" value="Login">
        </form>
    </div>
</body>
</html>
