<!DOCTYPE html>
<html>

<head>
    <title>Edit Criminal Data</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 220px;
            background-color: #2c2f4a;
            color: white;
            padding-top: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 60px;
            opacity: 0.3;
        }

        .nav {
            list-style: none;
            padding: 0;
        }

        .nav li {
            padding: 15px 20px;
            cursor: pointer;
            color: white;
        }

        .nav li.active,
        .nav li:hover {
            background-color: #3a3f5c;
        }

        .main-content {
            flex: 1;
            position: relative;
            background-color: #e4e4e4;
            padding: 40px;
            overflow: auto;
        }

        .main-content::before {
            content: "";
            background-image: url('shield.png'); /* Replace with your actual image path */
            background-repeat: no-repeat;
            background-position: center;
            background-size: 40%;
            opacity: 0.08;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .main-content h2 {
            position: relative;
            z-index: 1;
            margin-top: 0;
        }

        .form-wrapper {
            position: relative;
            z-index: 1;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.96);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-wrapper input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
        }

        .form-wrapper label {
            font-weight: bold;
        }

        .button-area {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: flex;
            gap: 10px;
            z-index: 1000;
        }


        .button-area input[type="submit"] {
            padding: 10px 20px;
            background-color: #2c2f4a;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .button-area input[type="submit"]:hover {
            background-color: #3a3f5c;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <img src="logo.png" alt="Logo">
            </div>
            <ul class="nav">
                <?php
                include('db_connect.php');
                $query = mysqli_query($conn, "SELECT * FROM criminal");
                while ($row = mysqli_fetch_array($query)) {
                    $active = (isset($_GET['update']) && $_GET['update'] == $row['Crino']) ? 'active' : '';
                    echo "<li class='$active'><a style='color:white;text-decoration:none;' href='EditCriminal.php?update={$row['Crino']}'>Criminal ID: {$row['Crino']}</a></li>";
                }
                ?>
            </ul>
        </div>

        <div class="main-content">
            <h2>Criminal Info</h2>

            <?php
            if (isset($_GET['submit'])) {
                $Cid = $_GET['id'];
                $Cname = $_GET['Name'];
                $Ccomm = $_GET['comm'];
                $Cadd = $_GET['add'];
                $CNat = $_GET['nat'];

                mysqli_query($conn, "UPDATE criminal SET Criname='$Cname', address='$Cadd', nationality='$CNat', crimes_comm='$Ccomm' WHERE Crino='$Cid'");
                header("Location: Criminals.php");
            }

            if (isset($_GET['back'])) {
                header("Location: Criminals.php");
            }

            if (isset($_GET['update'])) {
                $update = $_GET['update'];
                $query1 = mysqli_query($conn, "SELECT * FROM criminal WHERE Crino=$update");
                while ($row1 = mysqli_fetch_array($query1)) {
                    echo "<form class='form-wrapper' method='get'>";
                    echo "<input type='hidden' name='id' value='{$row1['Crino']}' />";
                    echo "<label>Name:</label><br />";
                    echo "<input type='text' name='Name' value='{$row1['Criname']}' /><br />";
                    echo "<label>Address:</label><br />";
                    echo "<input type='text' name='add' value='{$row1['address']}' /><br />";
                    echo "<label>Nationality:</label><br />";
                    echo "<input type='text' name='nat' value='{$row1['nationality']}' /><br />";
                    echo "<label>Crimes Committed:</label><br />";
                    echo "<input type='text' name='comm' value='{$row1['crimes_comm']}' /><br />";
                    echo "<div class='button-area'>";
                    echo "<input type='submit' name='submit' value='Update' />";
                    echo "<input type='submit' name='back' value='Go Back' />";
                    echo "</div>";
                    echo "</form>";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
