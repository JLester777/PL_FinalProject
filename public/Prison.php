<?php
include('db_connect.php');
include('role.php');

$sql = 'SELECT * FROM prisons';
$result = mysqli_query($conn, $sql);
$prisons = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Prisons</title>
    <style>
        :root {
            --primary: rgb(0, 0, 255);
            --primary-dark: rgb(0, 0, 190);
            --gray: #f2f2f2;
            --text: #333;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--gray);
            margin: 0;
            padding: 0;
        }
        h1 {
            padding: 20px;
            margin: 0;
            color: var(--text);
        }
        #main-div-1 {
            background-color: #fff;
            padding: 20px;
            border-bottom: 1px solid #ccc;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        #div-1 {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-left: auto;
        }
        .button-1 {
            padding: 10px 16px;
            border: none;
            border-radius: 5px;
            background-color: var(--primary);
            color: white;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .button-1:hover {
            background-color: var(--primary-dark);
        }
        #container {
            display: flex;
            height: calc(90vh - 130px);
        }
        #main-div-2 {
            flex: 1;
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            padding: 20px;
            overflow-y: auto;
        }
        .prison-card {
            background-color: grey;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.54);
            width: 280px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .prison-card:hover {
            transform: translateY(-3px);
        }
        .card-header {
            background-color: var(--primary);
            color: white;
            padding: 15px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .card-title {
            font-size: 18px;
            font-weight: bold;
        }
        .card-body {
            padding: 12px 16px;
            color: var(--text);
        }
        #detail-view {
            flex: 1;
            background-color: white;
            padding: 30px;
            border-left: 1px solid #ccc;
            display: none;
            flex-direction: column;
        }
        #detail-view h2 {
            margin-bottom: 16px;
            font-size: 24px;
            color: var(--text);
        }
        #detail-view p {
            margin: 10px 0;
            font-size: 16px;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            width: 160px;
        }
    </style>
</head>
<body>

<?php include('header.html'); ?>

<div id="main-div-1">
    <h1>&nbsp;PRISONS</h1>
    <?php if ($role == 1 || $role == 2) { ?>
    <div id="div-1">
        <a class="button-1" href="AddPrison.php">Add Data</a>
        <a class="button-1" href="DeletePrison.php">Delete Data</a>
        <a class="button-1" href="EditPrison.php">Edit Data</a>
    </div>
    <?php } ?>
</div>

<div id="container">
    <div id="main-div-2">
        <?php foreach ($prisons as $prison) { ?>
            <div class="prison-card" onclick='showDetails(<?php echo json_encode($prison); ?>)'>
                <div class="card-header">
                    <div class="card-title">
                        <?php echo htmlspecialchars($prison['prisonname']); ?><br>
                        <small>ID: <?php echo htmlspecialchars($prison['prisonid']); ?></small>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Type:</strong> <?php echo htmlspecialchars($prison['prisontype']); ?></p>
                    <p><strong>City:</strong> <?php echo htmlspecialchars($prison['prisoncity']); ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="detail-view">
        <h2 id="detail-name">Select a Prison</h2>
        <p><strong class="label">Prison ID:</strong> <span id="detail-id"></span></p>
        <p><strong class="label">Prison Name:</strong> <span id="detail-name-detail"></span></p>
        <p><strong class="label">Type:</strong> <span id="detail-type"></span></p>
        <p><strong class="label">City:</strong> <span id="detail-city"></span></p>
    </div>
</div>

<script>
function showDetails(prison) {
    document.getElementById("detail-name").textContent = prison.prisonname || "N/A";
    document.getElementById("detail-id").textContent = prison.prisonid || "N/A";
    document.getElementById("detail-name-detail").textContent = prison.prisonname || "N/A";
    document.getElementById("detail-type").textContent = prison.prisontype || "N/A";
    document.getElementById("detail-city").textContent = prison.prisoncity || "N/A";

    document.getElementById("detail-view").style.display = "flex";
}
</script>

</body>
</html>
