<?php
session_start();
if (isset($_POST['adminbutton'])) {
    header("Location: adminlogin.php");
}
if (isset($_POST['policebutton'])) {
    header("Location: policelogin.php");
}
if (isset($_POST['courtbutton'])) {
    header("Location: courtlogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Police Crime Record Management System</title>
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo-wrapper">
   <img src="logo.png" class="logo shine-img" alt="Logo">

</div>

        </div>
        <div class="right-panel">
            <div class="loginbox">
                <form action="" method="post">
                    <h2 style="color: white; ">Login</h2>
                    <input type="submit" name="adminbutton" value="Chief admin">
                    <input type="submit" name="policebutton" value="Police Staff">
                    <input type="submit" name="courtbutton" value="Court Staff">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
