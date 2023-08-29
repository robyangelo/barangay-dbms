<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Tracking Menu</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="track_menu.css">
</head>

<body>  
        <nav>
        <a href="user1.html" class="logo"><i class="bx bx-home-alt"></i></a>
        <ul class="nav_links">
            <li><a href="docu_menu.php">Request Document</a></li>
            <li><a href="Appointment.php">Schedule Appointment</a></li>
            <li><a href="track_menu.php">Track Request</a></li>
            <li><a href="faqs.html">FAQs</a></li>
        </ul>
        <a class="admin" href="login.php"><button>Admin</button></a>
        </nav>

        <div class="main_content">
            <div class="documentmenu">
                <ul>
                    <li>
                        <span><i class="bx bx-file"></i></span>
                        <h3>TRACKING MENU</h3>
                    </li>
                </ul>
            </div>
            
            <div class="info_card">
                <div class="cards1">
                    <ul>
                        <li>
                    <a href="track_request.php"><button class="button1">
                        <img src="images/docu.png">
						<h2>DOCUMENT REQUEST</h2>
                    </button></a>
                    </li>
                        <li>
                    <a href="track_appointment.php"><button class="button2">
                        <img src="images/app.png">
						<h2>APPOINTMENT SCHEDULE</h2>
                    </button></a>
                </li>
       
                </ul>
                </div>
                    </div>
                </div> 
</body>
</html>