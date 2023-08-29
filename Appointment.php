<?php
require('connection.inc.php');


if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$contactno=$_POST['contactno'];
	$purpose=$_POST['purpose'];
	$app_date=$_POST['app_date'];
	 

	$str_result = '0123456789';
   	$id = substr(str_shuffle($str_result), 0, 7);
	$app_id = 'APP-'.$id;
	
			$sql1 = "insert into appointment_tbl(app_id, name, contactno, purpose, app_date, status, app_slip) values('$app_id','$name','$contactno','$purpose','$app_date', 0, '')";	
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

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Appointment Schedule</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="appointment.css">
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
                  <form method="post"  action = "" class="form" >
        <div class="wrapper">
            <h1>APPOINTMENT SCHEDULE</h1>
			<hr>
			<p>REQUEST FORM</p>
                <table>
                <tr>
                    <td><label>Name:</label></td>
                    <td><input type="text" name ="name" id="name" required></td>
                </tr>
                <tr>
                    <td><label>Contact Number:</label></td>
                    <td><input type="text" name ="contactno" id="contactno" required></td>
                </tr>
                <tr>
                    <td><label>Purpose:</label></td>
                    <td><input type="text" name ="purpose" id="purpose" required></td>
                </tr>
                <tr>
                    <td><label>Schedule:</label></td>
					
		                <td>
							<select class="form-control" name="app_date" id="app_date" required>
							<option>yyyy-mm-dd</option>

							<?php 
							$sqli = "SELECT * FROM app_sched";
							$result = mysqli_query($con, $sqli);
							while ($row = mysqli_fetch_array($result)) {
							echo '<option>'.$row['app_sched'].'</option>';
							}

							echo '</select>';

							?>
                        </td>
                </tr>
                </table>
			<input type="submit" value="Submit" name="submit" id="submit" class="btn" />
		</div>
   </form>
  </body>
</html>