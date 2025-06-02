<?php
include('db_connect.php');
include('role.php');

$order = '';
if (isset($_GET['sort'])) {
    switch ($_GET['sort']) {
        case 'name_asc': $order = 'ORDER BY courtname ASC'; break;
        case 'name_desc': $order = 'ORDER BY courtname DESC'; break;
        case 'id_asc': $order = 'ORDER BY courtid ASC'; break;
        case 'id_desc': $order = 'ORDER BY courtid DESC'; break;
    }
}

$sql = "SELECT * FROM courts $order";
$result = mysqli_query($conn, $sql);
$courts = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<title>Courts</title>
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

    .court-card {
        background-color: grey;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.54);
        width: 280px;
        padding: 16px;
        color: var(--text);
        cursor: pointer;
        transition: transform 0.2s;
    }
    .court-card:hover {
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
        width: 140px;
    }
</style>
</head>
<body>

<?php include('header.html'); ?>

<div id="main-div-1">
    <h1>&nbsp;COURTS</h1>
    <?php if ($role == 1 || $role == 3) { ?>
        <div id="div-1">
            <a class="button-1" href="AddCourt.php">Add Data</a>
            <a class="button-1" href="DeleteCourt.php">Delete Data</a>
            <a class="button-1" href="EditCourt.php">Edit Data</a>
        </div>
    <?php } ?>
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

<div id="container">
    <div id="main-div-2">
        <?php foreach ($courts as $court) { ?>
            <div class="court-card" onclick='showDetails(<?php echo json_encode($court); ?>)'>
                <p><strong>Court ID:</strong> <?php echo htmlspecialchars($court['courtid']); ?></p>
                <p><strong>Court Name:</strong> <?php echo htmlspecialchars($court['courtname']); ?></p>
                <p><strong>Type:</strong> <?php echo htmlspecialchars($court['courttype']); ?></p>
                <p><strong>City:</strong> <?php echo htmlspecialchars($court['courtcity']); ?></p>
            </div>
        <?php } ?>
    </div>

    <div id="detail-view">
        <h2 id="detail-name">Select a Court</h2>
        <p><strong class="label">Court ID:</strong> <span id="detail-id"></span></p>
        <p><strong class="label">Court Name:</strong> <span id="detail-name-detail"></span></p>
        <p><strong class="label">Type:</strong> <span id="detail-type"></span></p>
        <p><strong class="label">City:</strong> <span id="detail-city"></span></p>
    </div>
</div>

<script>
function showDetails(court) {
    document.getElementById("detail-name").textContent = court.courtname || "N/A";
    document.getElementById("detail-id").textContent = court.courtid || "N/A";
    document.getElementById("detail-name-detail").textContent = court.courtname || "N/A";
    document.getElementById("detail-type").textContent = court.courttype || "N/A";
    document.getElementById("detail-city").textContent = court.courtcity || "N/A";

    document.getElementById("detail-view").style.display = "flex";
}
</script>

</body>
</html>
