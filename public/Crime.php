<?php
include('db_connect.php');
include('role.php');

$order = '';
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'name_asc': $order = 'ORDER BY Criname ASC'; break;
        case 'name_desc': $order = 'ORDER BY Criname DESC'; break;
        case 'no_asc': $order = 'ORDER BY Crino ASC'; break;
        case 'no_desc': $order = 'ORDER BY Crino DESC'; break;
    }
}

$sql = "SELECT * FROM crimes $order";
$result = mysqli_query($conn, $sql);
$crimes = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Crimes</title>
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
        gap: 12px;
        margin-left: auto;
        flex-wrap: wrap;
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
        background-color: #fff;
    }

    #main-div-2 {
        flex: 1;
        display: flex;
        flex-wrap: wrap;
        gap: 16px;
        padding: 20px;
        overflow-y: auto;
        background-color: var(--gray);
    }

    .crime-card {
        background-color: grey;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.54);
        width: 280px;
        padding: 16px;
        color: var(--text);
        cursor: pointer;
        transition: transform 0.2s;
    }
    .crime-card:hover {
        transform: translateY(-3px);
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
    <h1>&nbsp;CRIMES</h1>
    <div id="div-1">
        <a class="button-1 btn btn-success btn-lg" href="AddCrime.php" role="button">Add Data</a>
        <a class="button-1 btn btn-danger btn-lg" href="DeleteCrime.php" role="button">Delete Data</a>
        <a class="button-1 btn btn-primary btn-lg" href="EditCrime.php" role="button">Edit Data</a>
        <a class="button-1 btn btn-secondary btn-lg" href="OldCrime.php" role="button">Old Data</a>
    </div>
    <form method="get" class="sort-form">
        <label for="sort" style="font-weight: bold;">Sort by:</label>
        <select name="sort" id="sort" onchange="this.form.submit()">
            <option value="">-- Select --</option>
            <option value="name_asc" <?php if(@$_GET['sort'] == 'name_asc') echo 'selected'; ?>>Name A-Z</option>
            <option value="name_desc" <?php if(@$_GET['sort'] == 'name_desc') echo 'selected'; ?>>Name Z-A</option>
            <option value="no_asc" <?php if(@$_GET['sort'] == 'no_asc') echo 'selected'; ?>>Criminal Number Asc</option>
            <option value="no_desc" <?php if(@$_GET['sort'] == 'no_desc') echo 'selected'; ?>>Criminal Number Desc</option>
        </select>
    </form>
</div>

<div id="container">
    <div id="main-div-2">
        <?php foreach ($crimes as $crime) { ?>
            <div class="crime-card" onclick='showDetails(<?php echo json_encode($crime); ?>)'>
                <p><strong>Criminal Number:</strong> <?php echo htmlspecialchars($crime['Crino']); ?></p>
                <p><strong>Criminal Name:</strong> <?php echo htmlspecialchars($crime['Criname']); ?></p>
                <p><strong>Crime No:</strong> <?php echo htmlspecialchars($crime['Crno']); ?></p>
                <p><strong>Crime Category:</strong> <?php echo htmlspecialchars($crime['Crname']); ?></p>
                <p><strong>Date of Crime:</strong> <?php echo htmlspecialchars($crime['Crdate']); ?></p>
            </div>
        <?php } ?>
    </div>

    <div id="detail-view">
        <h2 id="detail-criminal-name">Select a Crime</h2>
        <p><strong class="label">Criminal Number:</strong> <span id="detail-criminal-number"></span></p>
        <p><strong class="label">Criminal Name:</strong> <span id="detail-criminal-name-detail"></span></p>
        <p><strong class="label">Crime No:</strong> <span id="detail-crime-no"></span></p>
        <p><strong class="label">Crime Category:</strong> <span id="detail-crime-category"></span></p>
        <p><strong class="label">Date of Crime:</strong> <span id="detail-crime-date"></span></p>
    </div>
</div>

<script>
function showDetails(crime) {
    document.getElementById("detail-criminal-name").textContent = crime.Criname || "N/A";
    document.getElementById("detail-criminal-number").textContent = crime.Crino || "N/A";
    document.getElementById("detail-criminal-name-detail").textContent = crime.Criname || "N/A";
    document.getElementById("detail-crime-no").textContent = crime.Crno || "N/A";
    document.getElementById("detail-crime-category").textContent = crime.Crname || "N/A";
    document.getElementById("detail-crime-date").textContent = crime.Crdate || "N/A";

    document.getElementById("detail-view").style.display = "flex";
}
</script>

</body>
</html>
