<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include('logout.html');	
?>
<head>
    <meta charset="UTF-8">
    <title>PCRMS Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Prevent scrolling on the whole page */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        .top-navbar {
            height: 50px;
            background-color: #343a40;
            color: white;
            display: flex;
            align-items: center;
            padding: 0 1rem;
            font-size: 20px;
            font-weight: bold;
        }

        .main-container {
            display: flex;
            height: calc(100% - 50px); /* Remaining height after navbar */
        }

        .sidebar {
            width: 220px;
            background-color: #2c2f3f;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 1rem 0.5rem;
        }

        .sidebar img.ribbon {
            width: 80px;
            margin: 0 auto 20px auto;
            display: block;
        }

        .sidebar form button {
            background: none;
            color: white;
            padding: 12px 20px;
            border: none;
            width: 100%;
            text-align: left;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        .sidebar form button:hover {
            background-color: white;
            color: #2c2f3f;
            border-radius: 4px;
        }

        .logout {
            margin-top: auto;
            padding: 10px 15px;
        }

		.dashboard {
			flex: 1;
			padding: 2rem;
			overflow-y: auto;
		}

		.dashboard-container {
			background-color: white;
			padding: 2rem;
			border-radius: 15px;
			box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
			max-width: 1000px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 20px;
		}

		.dashboard-container form {
			width: 100%;
		}

		.dashboard .btn {
			position: relative;
			width: 100%;
			border: none;
			height: 160px;
			padding: 20px;
			color: white;
			font-weight: bold;
			font-size: 18px;
			border-radius: 15px;
			transition: all 0.3s ease-in-out;
			text-align: left;
			display: flex;
			flex-direction: column;
			justify-content: space-between;
			cursor: pointer;
		}

		.dashboard .btn i {
			font-size: 28px;
		}

		.card-label {
			position: absolute;
			bottom: 10px;
			left: 15px;
			font-size: 28px;
			font-weight: 900;
			opacity: 0.2;
			text-transform: uppercase;
			pointer-events: none;
		}

		/* Hover opacity */
		.dashboard .btn:hover {
			opacity: 0.9;
		}

		/* Unique background colors */
		.dashboard-container form:nth-child(1) .btn {
			background-color: #1e3a8a; /* Blue */
		}

		.dashboard-container form:nth-child(2) .btn {
			background-color: #047857; /* Green */
		}

		.dashboard-container form:nth-child(3) .btn {
			background-color: #b91c1c; /* Red */
		}

		.dashboard-container form:nth-child(4) .btn {
			background-color: #92400e; /* Orange/Brown */
		}

		.dashboard-container form:nth-child(5) .btn {
			background-color: #6b21a8; /* Purple */
		}



    </style>
</head>
<body>
    <div class="main-container">
        <div class="sidebar">
            <img src="logo.png" class="ribbon" alt="Logo">
            <form method="POST" action="Welcome.php"><button><i class="fa fa-home"></i> Home</button></form>
            <form method="POST" action="Police.php"><button><i class="fa-solid fa-user-tie"></i> Police</button></form>
            <form method="POST" action="Criminals.php"><button><i class="fa-solid fa-user-ninja"></i> Criminals</button></form>
            <form method="POST" action="Crime.php"><button><i class="fa-solid fa-handcuffs"></i> Crimes</button></form>
            <form method="POST" action="Court.php"><button><i class="fa-solid fa-scale-balanced"></i> Court</button></form>
            <form method="POST" action="Prison.php"><button><i class="fa-solid fa-building-shield"></i> Prison</button></form>
             
        </div>

		<div class="dashboard">
			<div class="dashboard-container">
				<form method="POST" action="Police.php">
					<button class="btn">
						<i class="fa-solid fa-user-tie"></i> Police Information
						<div class="card-label">Police</div>
					</button>
				</form>
				<form method="POST" action="Criminals.php">
					<button class="btn">
						<i class="fa-solid fa-user-ninja"></i> Criminal Information
						<div class="card-label">Criminals</div>
					</button>
				</form>
				<form method="POST" action="Crime.php">
					<button class="btn">
						<i class="fa-solid fa-handcuffs"></i> Crime Information
						<div class="card-label">Crime</div>
					</button>
				</form>	
				<form method="POST" action="Court.php">
					<button class="btn">
						<i class="fa-solid fa-scale-balanced"></i> Court Information
						<div class="card-label">Court</div>
					</button>
				</form>
				<form method="POST" action="Prison.php">
					<button class="btn">
						<i class="fa-solid fa-building-shield"></i> Prison Information
						<div class="card-label">Prison</div>
					</button>
				</form>
			</div>
		</div>

    </div>

</body>
</html>
