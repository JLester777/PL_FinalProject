<?php
include('db_connect.php');

if (isset($_POST['policebclk'])) {
    $Pid = $_POST['id'];
    $Pname = $_POST['Name'];
    $Pstation = $_POST['Pstation'];
    $PContact = $_POST['Contact'];
    $Pbirthdate = $_POST['birthdate'];
    $Pgender = $_POST['gender'];
    $Page = $_POST['age'];
    $Paddress = $_POST['address'];

    $sql = "INSERT INTO `police` (`pid`, `Poname`, `policestation`, `contact`, `birthdate`, `gender`, `age`, `address`) 
            VALUES ('$Pid', '$Pname', '$Pstation', '$PContact', '$Pbirthdate', '$Pgender', '$Page', '$Paddress')";

    $rs = mysqli_query($conn, $sql);

    if (!$rs) {
        echo mysqli_error($conn);
    } else {
        header("Location: Police.php");
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('header.html'); ?>
<?php include('AddData.html'); ?>

<div class="form">
    <form method="POST" action="AddPolice.php">
        <div class="contain">
            <span id="title">
                <h1>Add Police</h1>
                <p>Please fill the details of the new police</p>
            </span>
            <hr>

            <label for="id"><b>Police ID:</b></label>
            <input type="text" placeholder="Enter ID" name="id" id="id" required>
            <br>

            <label for="Name"><b>Name:</b></label>
            <input type="text" placeholder="Enter Name" name="Name" id="nm" required>
            <br>

            <label for="Pstation"><b>Police Station:</b></label>
            <input type="text" placeholder="Enter Police Station" name="Pstation" id="Ps" required>
            <br>

            <label for="Contact"><b>Contact Number:</b></label>
            <input type="text" placeholder="Enter Contact Number" name="Contact" id="ctc" required>
            <br>

            <label for="birthdate"><b>Birthdate (MM/DD/YYYY):</b></label>
            <input type="date" name="birthdate" id="birthdate" required>
            <br>

            <label for="gender"><b>Gender:</b></label>
            <select name="gender" id="gender" required>
                <option value="">Select</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <br>
            <label for="age"><b>Age:</b></label>
            <input type="number" name="age" id="age" placeholder="Enter Age" required>
            <br>

            <label for="address"><b>Address:</b></label>
            <input type="text" name="address" id="address" placeholder="Enter Address" required>
            <br>

            <a class="button-1 btn btn-secondary btn-lg" href="Police.php" role="button">Go Back</a>
            <button class="button-1 btn btn-success btn-lg" value="Save" name="policebclk">Save</button>
        </div>
    </form>
</div>

</body>
</html>
