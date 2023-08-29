<?php
require('connection.inc.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$id=$_GET['id'];
$sql="select * from citizen_tbl where id = '".$id."'";
$res=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$age=$_POST['age'];
	$zone_add=$_POST['zone_add'];
	$email=$_POST['email'];
	$contactno=$_POST['contactno'];
	$sex=$_POST['sex'];
	 		
	$sql1 = "update citizen_tbl set name='$name', age='$age', zone_add='$zone_add', email='$email', contactno='$contactno', sex='$sex' where id='".$id."'"; 
	$result = mysqli_query($con, $sql1);
		if($result){
			echo '<script>alert("Citizen has been updated.")</script>';
			echo'<script>
				if ( window.history.replaceState ) {
				  window.history.replaceState( null, null, window.location.href );
				}
				</script>';
		}else{
			echo '<script>alert("Invalid input! Citizen record not updated.")</script>';
			echo'<script>
				if ( window.history.replaceState ) {
				  window.history.replaceState( null, null, window.location.href );
				}
				</script>';
		}
	}
	
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Citizen Database | Update Citizen</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="citizen.css">
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

    <form method="post"  action="" class="form">
    <div class="form-step">
		<br>
      <h2 class="text-center">CITIZEN DATABASE</h2>
		<hr>
    <p>ADMIN | UPDATE CITIZEN</p>
       
       
		 
        <div class="input-group">
            <label for="name">Name</label><br>
              <input type="text" name="name" id="name" value="<?php echo $row['name'];?>"/>
          </div>
		<div class="input-group">
            <label for="age">Age</label><br>
              <input type="text" name="age" id="age" value="<?php echo $row['age'];?>"/>
          </div>
		<div class="input-group">
            <label for="zone_add">Zone Address</label><br>
              <input type="text" name="zone_add" id="zone_add" value="<?php echo $row['zone_add'];?>"/>
          </div>
		<div class="input-group">
            <label for="email">Email</label><br>
              <input type="text" name="email" id="email" value="<?php echo $row['email'];?>"/>
          </div>
		<div class="input-group">
            <label for="mobile_no">Contact Number</label><br>
              <input type="text" name="contactno" id="contactno" value="<?php echo $row['contactno'];?>"/>
          </div>
		 <div class="input-group">
          <label for="gender">Gender</label>
          <select name="sex" id="sex" value="">
			  <option><?php echo $row['sex'];?></option>
            <option>Male</option>
            <option >Female</option>
          </select>
        </div>
            <div class="btns">
              <input type="submit" value="Update" name="submit" class="btn" />
        </div>
     </div>
</form>
</body>
</html>