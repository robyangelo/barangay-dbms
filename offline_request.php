<?php
require('connection.inc.php');

if(!isset($_SESSION['username'])){
    header('location:login.php');
}

	$name='';
	$docu_type='';
	$str_result = '0123456789';
   	$id = substr(str_shuffle($str_result), 0, 7);
	$trans_id = 'CERT-'.$id;
	
if(isset($_POST['submit'])){
	$name=$_POST['name'];
	$trans_id=$_POST['trans_id'];
	$docu_type=$_POST['docu_type'];
	$date=date('Y-m-d');
	$sql1 = "insert into off_trans(trans_id, name, docu_type, app_date, status) values('$trans_id', '$name', '$docu_type', '$date' ,4)";
	$result = mysqli_query($con, $sql1);
		if($result){
			echo '<script>alert("Request has been submitted.")</script>';
			echo'<script>
				if ( window.history.replaceState ) {
				  window.history.replaceState( null, null, window.location.href );
				}
				</script>';
		}else {
			echo '<script>alert("Invalid input! Request not recorded.")</script>';
		echo'<script>
			if ( window.history.replaceState ) {
			  window.history.replaceState( null, null, window.location.href );
			}
			</script>';
}				
	$name='';
	$docu_type='Select Document Type';
	$str_result = '0123456789';
   	$id = substr(str_shuffle($str_result), 0, 7);
	$trans_id = 'CERT-'.$id;
	}
	
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Request Form</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="offline_request.css">
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
      <h2 class="text-center">REQUEST FORM</h2>
		<hr>
    <p>ADMIN | OFFLINE REQUEST</p>
       
       
		 <div class="input-group">
          <label for="trans_id">Transaction ID</label>
          <input type="text" name="trans_id" id="trans_id" value="<?php echo $trans_id ?>"/>
        </div>
        <div class="input-group">
            <label for="name">Name</label><br>
              <input type="text" name="name" id="name"/>
          </div>
        <div class="input-group">
          <label for="doc">Document Type</label>
          <select name="docu_type" id="docu_type">
			  <option>Select Document Type</option>
            <option>CLEARANCE</option>
            <option >BUSINESS PERMIT</option>
            <option >BUILDING PERMIT</option>
            <option>CERTIFICATE OF RESIDENCY</option>
			  <option>CEDULA</option>
          </select>
        </div>
            <div class="btns">
              <input type="submit" value="Submit" name="submit" class="btn" />
        </div>
     </div>
</form>
</body>
</html>