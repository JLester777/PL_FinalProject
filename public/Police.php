<?php
include('db_connect.php');
include('role.php');

// Handle update request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateProfile'])) {
    $id = $_POST['pid'];
    $name = $_POST['Poname'];
    $station = $_POST['policestation'];
    $contact = $_POST['contact'];
    $remarks = $_POST['remarks'];
    $sql = "UPDATE police SET Poname='$name', policestation='$station', contact='$contact', remarks='$remarks' WHERE pid='$id'";
    mysqli_query($conn, $sql);
}

// Handle delete request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteProfile']) && $_POST['confirmDelete'] === 'confirm') {
    $id = $_POST['pid'];
    $sql = "DELETE FROM police WHERE pid='$id'";
    mysqli_query($conn, $sql);
}

$sql = 'SELECT * FROM police';
$result = mysqli_query($conn, $sql);
$polices = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<?php include('header.html'); ?>

<head>
    <style>
        .police-card {
            background: #d9d9d9;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-family: sans-serif;
        }

        .police-card .top {
            padding: 1em;
            position: relative;
        }

        .police-card .top .badge {
            position: absolute;
            top: 1em;
            right: 1em;
            width: 60px;
            height: 60px;
        }

        .police-card .top .name {
            font-size: 1.5em;
            font-weight: bold;
        }

        .police-card .top .id {
            font-size: 0.8em;
            color: #444;
        }

        .police-card .bottom {
            background: #252a3f;
            color: white;
            padding: 0.5em 1em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .police-card .bottom .circle {
            width: 40px;
            height: 40px;
            background: white;
            border-radius: 50%;
        }

        .police-card .bottom .details-btn {
            background: white;
            color: #252a3f;
            border: none;
            padding: 0.3em 0.8em;
            border-radius: 4px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>POLICE</h1>

    <?php if ($role == 1 || $role == 2) { ?>
        <div style="margin-bottom: 1em;">
            <a class="btn btn-success btn-lg" href="AddPolice.php" role="button">Add Data</a>
        </div>
    <?php } ?>

    <div class="row">
        <?php foreach ($polices as $police) { ?>
            <div class="col-md-4 mb-3">
                <div class="police-card">
                    <div class="top">
                        <div class="name"><?php echo htmlspecialchars($police['Poname']); ?></div>
                        <div class="id">Police ID: <?php echo htmlspecialchars($police['pid']); ?></div>
                        <img src="badge.png" alt="Badge" class="badge"> <!-- Replace with actual badge image -->
                    </div>
                    <div class="bottom">
                        <div>
                            <div>Department</div>
                            <div class="circle"></div>
                        </div>
                        <button class="details-btn" onclick='showDocuView(<?php echo json_encode($police); ?>)'>detail...</button>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>

    <!-- Modal -->
    <div id="docuModal" class="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#000000aa;">
        <div class="modal-content" style="background:white; margin:10% auto; padding:20px; width:60%; position:relative;">
            <span onclick="document.getElementById('docuModal').style.display='none'" style="position:absolute; top:10px; right:20px; cursor:pointer; font-size:20px;">&times;</span>
            <form method="post">
                <input type="hidden" id="modalPid" name="pid">
                <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" name="Poname" id="modalName" readonly>
                </div>
                <div class="form-group">
                    <label>Police Station:</label>
                    <input type="text" class="form-control" name="policestation" id="modalStation" readonly>
                </div>
                <div class="form-group">
                    <label>Contact:</label>
                    <input type="text" class="form-control" name="contact" id="modalContact" readonly>
                </div>
                <div class="form-group">
                    <label>Remarks:</label>
                    <textarea class="form-control" name="remarks" id="remarks" rows="3" readonly></textarea>
                </div>
                <div id="editControls" style="display:none;">
                    <button type="submit" name="updateProfile" class="btn btn-success">Save</button>
                </div>
            </form>
            <button class="btn btn-warning" onclick="enableEdit()">Edit</button>
            <form method="post" style="margin-top:1em;">
                <input type="hidden" id="deletePid" name="pid">
                <div class="form-group">
                    <label>Type "confirm" to delete:</label>
                    <input type="text" class="form-control" name="confirmDelete">
                </div>
                <button type="submit" name="deleteProfile" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>

    <script>
        function showDocuView(police) {
            document.getElementById('docuModal').style.display = 'block';
            document.getElementById('modalPid').value = police.pid;
            document.getElementById('modalName').value = police.Poname;
            document.getElementById('modalStation').value = police.policestation;
            document.getElementById('modalContact').value = police.contact;
            document.getElementById('remarks').value = police.remarks || '';
            document.getElementById('deletePid').value = police.pid;
            disableEdit();
        }

        function enableEdit() {
            document.getElementById('modalName').readOnly = false;
            document.getElementById('modalStation').readOnly = false;
            document.getElementById('modalContact').readOnly = false;
            document.getElementById('remarks').readOnly = false;
            document.getElementById('editControls').style.display = 'block';
        }

        function disableEdit() {
            document.getElementById('modalName').readOnly = true;
            document.getElementById('modalStation').readOnly = true;
            document.getElementById('modalContact').readOnly = true;
            document.getElementById('remarks').readOnly = true;
            document.getElementById('editControls').style.display = 'none';
        }
    </script>
</body>

</html>
