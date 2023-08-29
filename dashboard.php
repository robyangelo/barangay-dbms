<?php
require('connection.inc.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$sql="call count_proc() ";
$res=mysqli_query($con,$sql);
$row=mysqli_fetch_assoc($res);

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="dashboard.css">
</head>
	<body>
        <div class="sidebar"> 
        <div class="logo_content">
        <div class=logo>
            <i class='bx bx-menu'></i>
            <div class="logo_name">Menu</div>
        </div>
        </div>
        <ul class="nav_list">
            <li><a href="dashboard.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </li>
            <li><a href="admin_tbl.php">
                <i class='bx bx-message-alt-error'></i>
                <span class="links_name">Certificate Requests</span>
            </li>
            <li><a href="appointment_tbl.php">
                <i class='bx bx-calendar'></i>
                <span class="links_name">Appointment Schedule</span>
            </li>
            <li><a href="citizen_tbl.php">
                <i class='bx bx-group'></i>
                <span class="links_name">Citizen Database</span>
            </li>
             <li><a href="settings.php">
                <i class='fa fa-gear'></i>
                <span class="links_name">Settings</a></span>
            </li>
			<li><a href="logout.php">
                <i class='fa fa-share-square-o'></i>
                <span class="links_name">Logout</a></span>
            </li>
        </ul>
    </div>

    <nav>
		<h1>WELCOME BACK, ADMIN</h1>
    </nav>

    
    <div class="main_content">

        <div class="dashboard">
            <ul>
                <li>
                    <span><i class='bx bxs-dashboard' ></i></span>
                    <h3>DASHBOARD</h3>
                </li>
            </ul>
        </div>
        
        <div class="info_card">
            <div class="card">
                <span><i class='bx bx-like'></i></span>
                <div class="number_detail">
                    <h2><?php echo $row['approve_count'];?></h2>
                    <p>TO APPROVE</p>
                </div>
            </div>
            <div class="card">
                <span><i class='bx bx-message-alt-dots'></i></span>
                <div class="number_detail">
					<h2><?php echo $row['pending_count'];?></h2>
                    <p>PENDING</p>
                </div>
            </div>
            <div class="card">
                <span><i class='bx bx-check-square'></i></span>
                <div class="number_detail">
                    <h2><?php echo $row['completed_count'];?></h2>
                    <p>COMPLETED</p>
                </div>
            </div>
        </div>

        <div class="info_card2">
            <div class="card2">
                <span><i class='bx bx-alarm'></i></span>
                <div class="number_detail">
                    <h2><?php echo $row['app_count'];?></h2>
                    <p>SCHEDULE TODAY</p>
                </div>
            </div>
            <div class="card2">
                <span><i class='bx bx-group' ></i></span>
                <div class="number_detail">
                    <h2><?php echo $row['cit_count'];?></h2>
                    <p>RESIDENTS</p>
                </div>
            </div> 
            </div>
        </div>
</body>
</html>