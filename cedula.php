<?php
require('connection.inc.php');


if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$address=$_POST['address'];
	$contactno=$_POST['contactno'];
	$citizenship=$_POST['citizenship'];
	$civil_status=$_POST['civil_status'];
	$birthdate=$_POST['birthdate'];
	$birthplace=$_POST['birthplace'];
	$mop=$_POST['mop'];
	$ref=$_POST['ref'];
	$app_date=$_POST['app_date'];
	 
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
			$str_result = '0123456789';
			$id = substr(str_shuffle($str_result), 0, 7);
			$trans_id = 'CERT-'.$id;

			$sql1 = "insert into cedula_tbl(trans_id, name, address, contactno, citizenship, civil_status, birthdate, birthplace, mop, ref, receipt, app_date) values('$trans_id', '$name','$address','$contactno','$citizenship', '$civil_status', '$birthdate','$birthplace', '$mop','$ref','$fileName','$app_date')";	
			$result = mysqli_query($con, $sql1);
			if($result){
				echo '<script>alert("Your request has been submitted.")</script>';
				echo'<script>
					if ( window.history.replaceState ) {
					  window.history.replaceState( null, null, window.location.href );
					}
					</script>';
			}else if($app_date=='yyyy-mm-dd'){
				echo '<script>alert("Invalid input! Request not submitted.")</script>';
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
    <link rel="stylesheet" href="request.css" />
    <script src="request.js" defer></script>
    <title>Cedula</title>
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
    
    <form method="post"  action = "" class="form" enctype="multipart/form-data">
      <h2 class="text-center">CEDULA</h2>
    
      <div class="progressbar">
        <div class="progress" id="progress"></div>
        
        <div class="progress-step progress-step-active" data-title="Request"></div>
        <div class="progress-step" data-title="Payment"></div>
        <div class="progress-step" data-title="Schedule"></div>
      </div>

      
      <div class="form-step form-step-active">
        <div class="input-group">
			<h1 class="subtext">REQUEST FORM</h1>
          <label for="username">Name</label>
          <input type="text" name="name" id="name" required />
        </div>
        <div class="input-group">
          <label for="zone">Address</label>
          <input type="text" name="address" id="address" required  />
        </div>
		  <div class="input-group">
          <label for="contactno">Contact Number</label>
          <input type="text" name="contactno" id="contactno" required  />
        </div>
        <div class="input-group">
            <label for="purpose">Citizenship</label>
            <input type="text" name="citizenship" id="citizenship"  required />
          </div>
		  <div class="input-group">
            <label for="purpose">Civil Status</label>
            <input type="text" name="civil_status" id="civil_status"  required />
          </div>
		  <div class="input-group">
            <label for="purpose">Birth Date</label>
            <input type="date" name="birthdate" id="birthdate" required />
          </div>
		  
		  <div class="input-group">
            <label for="purpose">Birth Place</label>
            <input type="text" name="birthplace" id="birthplace"  required />
          </div>
        <div class="">
			<a href="#" class="btn btn-next width-50 ml-auto" id ="next" type="submit">Next</a>
        
        </div>
      </div>
		
      <div class="form-step">
        <div class="input-group">
            <h1 class="subtext">PAYMENT FORM</h1>
          <label for="mode">Mode of Payment</label>
           <select class="form-control" name="mop" id="mop" required>
			<option>Select Mode of Payment</option>

			<?php 
			$sqli = "SELECT * FROM mop";
			$result = mysqli_query($con, $sqli);
			while ($row = mysqli_fetch_array($result)) {
			echo '<option>'.$row['mop'].'</option>';
			}

			echo '</select>';

			?>
        </div>
        <div class="input-group">
          <label for="ref">Reference Number</label>
          <input type="text" name="ref" id="ref"  required />
        </div>
        <div class="input-group-r">
          <label for="receipt">Receipt</label>
            <input type="file" name="file" id="file" required />
            
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <a href="#" class="btn btn-next">Next</a>
        </div>
        
      </div>
      
      <div class="form-step">
        <div class="input-group">
            <h1 class="subtext">SCHEDULE FORM</h1>
          <label for="sched">Choose Appointment Schedule</label>
           <select class="form-control" name="app_date" id="app_date">
			<option>yyyy-mm-dd</option>

			<?php 
			$sqli = "SELECT * FROM app_sched";
			$result = mysqli_query($con, $sqli);
			while ($row = mysqli_fetch_array($result)) {
			echo '<option>'.$row['app_sched'].'</option>';
			}

			echo '</select>';

			?>
      
        </div>
        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <input type="submit" value="Submit" name="submit" class="btn" />
        </div>
      </div>
    </form>
  </body>
</html>