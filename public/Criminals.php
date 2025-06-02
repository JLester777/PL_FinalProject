<?php
include('db_connect.php');
include('role.php');

$order = '';
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'name_asc': $order = 'ORDER BY Criname ASC'; break;
        case 'name_desc': $order = 'ORDER BY Criname DESC'; break;
        case 'id_asc': $order = 'ORDER BY Crino ASC'; break;
        case 'id_desc': $order = 'ORDER BY Crino DESC'; break;
    }
}

$sql = "SELECT * FROM criminal $order";
$result = mysqli_query($conn, $sql);
$criminals = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criminal Records</title>
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
        }

        #div-1 {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
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

        form.sort-form {
            margin-left: auto;
        }

        select {
            padding: 8px 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
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

        .criminal-card {
            background-color: grey;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.54);
            width: 280px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .criminal-card:hover {
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
        }

        .card-body p {
            margin: 8px 0;
            font-size: 14px;
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
    <h1>&nbsp;CRIMINALS</h1>
    <div id="div-1">
        <a class="button-1" href="AddCriminal.php">Add Data</a>
        <a class="button-1" href="DeleteCriminal.php">Delete Data</a>
        <a class="button-1" href="EditCriminal.php">Edit Data</a>
        <a class="button-1" href="OldCriminal.php">Old Data</a>
        <form method="get" class="sort-form">
            <label for="sort" style="font-weight: bold;">Sort by:</label>
            <select name="sort" id="sort" onchange="this.form.submit()">
                <option value="">-- Select --</option>
                <option value="name_asc" <?php if(@$_GET['sort'] == 'name_asc') echo 'selected'; ?>>Name A-Z</option>
                <option value="name_desc" <?php if(@$_GET['sort'] == 'name_desc') echo 'selected'; ?>>Name Z-A</option>
                <option value="id_asc" <?php if(@$_GET['sort'] == 'id_asc') echo 'selected'; ?>>ID Ascending</option>
                <option value="id_desc" <?php if(@$_GET['sort'] == 'id_desc') echo 'selected'; ?>>ID Descending</option>
            </select>
        </form>
    </div>
</div>

<div id="container">
    <div id="main-div-2">
        <?php foreach ($criminals as $criminal) { ?>
            <div class="criminal-card" onclick='showDetails(<?php echo json_encode($criminal); ?>)'>
                <div class="card-header">
                    <div class="card-title">
                        <?php echo htmlspecialchars($criminal['Criname']); ?><br>
                        <small>ID: <?php echo htmlspecialchars($criminal['Crino']); ?></small>
                    </div>
                </div>
                <div class="card-body">
                    <p><strong>Address:</strong> <?php echo htmlspecialchars($criminal['address']); ?></p>
                    <p><strong>Nationality:</strong> <?php echo htmlspecialchars($criminal['nationality']); ?></p>
                    <p><strong>Crimes:</strong> <?php echo htmlspecialchars($criminal['crimes_comm']); ?></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="detail-view">
        <h2 id="detail-name">Select a Criminal</h2>
        <p><strong class="label">Criminal ID:</strong> <span id="detail-id"></span></p>
        <p><strong class="label">Address:</strong> <span id="detail-address"></span></p>
        <p><strong class="label">Nationality:</strong> <span id="detail-nationality"></span></p>
        <p><strong class="label">Crimes Committed:</strong> <span id="detail-crimes"></span></p>
        <p><strong class="label">Other Info:</strong> <span id="detail-other"></span></p>
    </div>
</div>

<script>
function showDetails(criminal) {
    document.getElementById("detail-name").textContent = criminal.Criname || "N/A";
    document.getElementById("detail-id").textContent = criminal.Crino || "N/A";
    document.getElementById("detail-address").textContent = criminal.address || "N/A";
    document.getElementById("detail-nationality").textContent = criminal.nationality || "N/A";
    document.getElementById("detail-crimes").textContent = criminal.crimes_comm || "N/A";
    document.getElementById("detail-other").textContent = criminal.other_info || "N/A";

    document.getElementById("detail-view").style.display = "flex";
}
</script>

</body>
</html>
