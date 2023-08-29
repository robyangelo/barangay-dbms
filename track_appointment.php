<?php
require('connection.inc.php');

$sql="select * from extra";
$res=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);



if(isset($_POST['search'])){
	$search = $_POST['id'];		
	$sql="select * from appointment_tbl where app_id='$search'";
	$res=mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($res);
		if ($res) {
  			if (mysqli_num_rows($res) < 1) {
	  			$sql="select * from app_reject_tbl where app_id='$search'";
				$res=mysqli_query($con,$sql);
				$row = mysqli_fetch_assoc($res);
	  	if (mysqli_num_rows($res) < 1) {
    		echo '<script>alert("Record does not exist.")</script>';
			echo'<script>
				if ( window.history.replaceState ) {
				  window.history.replaceState( null, null, window.location.href );
				}
				</script>';
			echo '<script type="text/JavaScript"> location.reload(); </script>';
  		}	
	}
}

if(isset($_POST['download'])){
	$search = $_POST['id'];	
	$sql="select * from appointment_tbl where app_id='$search'";
	$res=mysqli_query($con,$sql);
	$row = mysqli_fetch_assoc($res);

	header("Content-Disposition: attachment; filename=".$row['app_slip']);
    header("Content-Type: application/octet-stream;");
    readfile("uploads/".$row['app_slip']);

}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
	<link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Track.css" />
    <title>Track | Appointment Schedule</title>
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
    
    <form action="#" class="form" method="post">
      <div class="form-details form-details-active">
        <div class="input-group">
            <h2 class="text-center">TRACKING</h2>
			<hr>
			<p>APPOINTMENT SCHEDULE</p>
            <div class="search_wrap search_wrap_5">
                <div class="search_box">
                    <input type="text" class="input" name="id" id="id" placeholder="Enter Appointment ID" value="<?php echo $row['app_id'];?>">
					<input type="submit" name="search" id="search" value="Search" class="btn"/>
            
                </div>
            </div>
        </div>
        <br>
		
		   <div class="input-group">
            <label>Appointment ID: </label>
            <label class="input" id="id"><?php echo $row['app_id'];?></label>
          </div>
          <div class="input-group">
            <label>Name: </label>
            <label class="input" id="name"><?php echo $row['name'];?></label>
          </div>
		  <div class="input-group">
            <label>Contact Number: </label>
            <label class="input" id="contactno"><?php echo $row['contactno'];?></label>
          </div>
		  <div class="input-group">
            <label>Purpose: </label>
            <label class="input" id="purpose"><?php echo $row['purpose'];?></label>
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" id="app_date"><?php echo $row['app_date'];?></label>
          </div>
          <div class="input-group">
            <label>Status: </label>
            <label class="input" id="status">
				<?php 
				if($row['status']==0){
					echo'TO APPROVE';
				}
				elseif($row['status']==1){
					echo'PENDING';
					
				}
				elseif($row['status']==2){
					echo'COMPLETED';
				}
				elseif($row['status']==3){
					echo'REJECTED';
				} ?>
			  </label>
            </div>
		

	 	<div class="download_wrap download_wrap_5">
              <div class="download_box">
                  <input type="text" class="input" value="<?php echo $row['app_slip'];?>" >
                  <input type="submit" name="download" id="download" value="Download" class="btn2"/>
                  </div>
              </div>
		
		 
    	<p class="note">Note: Blank means your appointment slip is not yet available</p>
		<p class="note">or your request is rejected.</p>
      </div>
    </form>
  </body>
</html>