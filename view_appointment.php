<?php
require('connection.inc.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$app_id=$_GET['app_id'];
$sql="select * from appointment_tbl where app_id = '".$app_id."'";
$res=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])){	 
	$targetDir = "uploads/";
	$fileName = basename($_FILES["file"]["name"]);
	$targetFilePath = $targetDir . $fileName;
	$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
	// Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif','pdf');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database      
			$sql1 = "update appointment_tbl set app_slip='$fileName' WHERE app_id='".$app_id."'";
			$result = mysqli_query($con, $sql1);	
				if($result){
					echo '<script>alert("File has been uploaded.")</script>';
					echo'<script>
						if ( window.history.replaceState ) {
						  window.history.replaceState( null, null, window.location.href );
						}
						</script>';
				}
				else{
					echo '<script>alert("Invalid format! File not uploaded.")</script>';
					echo'<script>
						if ( window.history.replaceState ) {
						  window.history.replaceState( null, null, window.location.href );
						}
						</script>';
				}				
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Appointment Schedule | View Details</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="view.css">
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

    <form action="" class="form" method="post" enctype="multipart/form-data">
    <div class="form-step">
		<br>
        <h2 class="text-center">APPOINTMENT SCHEDULE</h2>
		<hr>
    <p>VIEW DETAILS</p>
	
	
 <div class="input-group">
          <label>Appointment ID: </label>
          <label class="input" ><?php echo $row['app_id'];?></label>
        </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row['name'];?></label>
        </div>
        <div class="input-group">
            <label>Contact Number: </label>
            <label class="input" ><?php echo $row['contactno'];?></label>
          </div>
          <div class="input-group">
            <label>Purpose: </label>
            <label class="input" ><?php echo $row['purpose'];?></label>
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Appointment Slip: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
              <input type="submit" name="submit" value="Upload" class="btn" />
        </div>		
    </div>
</form>
</body>
</html>