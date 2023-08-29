<?php
require('connection.inc.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

$trans_id=$_GET['trans_id'];
$sql="select * from request_tbl where trans_id = '".$trans_id."'";
$res=mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

if($row['docu_type']=='CLEARANCE'){
	$sql1="select * from clearance_tbl where trans_id = '".$trans_id."'";
	$res1=mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	
	if(isset($_POST['view'])){
		$sql="select * from clearance_tbl where trans_id = '".$trans_id."'";
		$res=mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($res);

		header("Content-Disposition: attachment; filename=".$row['receipt']);
        header("Content-Type: application/octet-stream;");
        readfile("uploads/".$row['receipt']);
	}
	
}
elseif($row['docu_type']=='BUSINESS PERMIT'){
	$sql1="select * from businesspermit_tbl where trans_id = '".$trans_id."'";
	$res1=mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	
	if(isset($_POST['view'])){
		$sql="select * from businesspermit_tbl where trans_id = '".$trans_id."'";
		$res=mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($res);

  		header("Content-Disposition: attachment; filename=".$row['receipt']);
        header("Content-Type: application/octet-stream;");
        readfile("uploads/".$row['receipt']);
	}
}
elseif($row['docu_type']=='BUILDING PERMIT'){
	$sql1="select * from buildingpermit_tbl where trans_id = '".$trans_id."'";
	$res1=mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	
	if(isset($_POST['view'])){
		$sql="select * from buildingpermit_tbl where trans_id = '".$trans_id."'";
		$res=mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($res);

  		header("Content-Disposition: attachment; filename=".$row['receipt']);
        header("Content-Type: application/octet-stream;");
        readfile("uploads/".$row['receipt']);
	}
}
elseif($row['docu_type']=='CEDULA'){
	$sql1="select * from cedula_tbl where trans_id = '".$trans_id."'";
	$res1=mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	
	if(isset($_POST['view'])){
		$sql="select * from cedula_tbl where trans_id = '".$trans_id."'";
		$res=mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($res);

  		header("Content-Disposition: attachment; filename=".$row['receipt']);
        header("Content-Type: application/octet-stream;");
        readfile("uploads/".$row['receipt']);
	}
}
elseif($row['docu_type']=='RESIDENCY'){
	$sql1="select * from residency_tbl where trans_id = '".$trans_id."'";
	$res1=mysqli_query($con,$sql1);
	$row1 = mysqli_fetch_assoc($res1);
	
	if(isset($_POST['view'])){
		$sql="select * from residency_tbl where trans_id = '".$trans_id."'";
		$res=mysqli_query($con,$sql);
		$row = mysqli_fetch_assoc($res);

  		header("Content-Disposition: attachment; filename=".$row['receipt']);
        header("Content-Type: application/octet-stream;");
        readfile("uploads/".$row['receipt']);
	}
}

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
			$sql1 = "update request_tbl set docu_file='$fileName' WHERE trans_id='".$trans_id."'";
			$result = mysqli_query($con, $sql1);
				if($result){
					echo '<script>alert("File has been uploaded.")</script>';
					echo'<script>
						if ( window.history.replaceState ) {
						  window.history.replaceState( null, null, window.location.href );
						}
						</script>';
				}
				else {
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
    <title>Certificate Requests | View Details</title>
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
        <h2 class="text-center">CERTIFICATE REQUESTS</h2>
		<hr>
    <p>VIEW DETAILS</p>
	<?php
		if($row['docu_type']=='CLEARANCE'){ ?>
	
 <div class="input-group">
          <label>Transaction ID: </label>
          <label class="input" ><?php echo $row['trans_id'];?></label>
        </div>
        <div class="input-group">
          <label>Document Type: </label>
          <label class="input" ><?php echo $row['docu_type'];?></label>
        </div>
        <div class="input-group">
            <label>Cedula Number: </label>
            <label class="input" ><?php echo $row1['cedula_no'];?></label>
          </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row1['name'];?></label>
        </div>
        <div class="input-group">
            <label>Zone Address: </label>
            <label class="input" ><?php echo $row1['zone_add'];?></label>
          </div>
          <div class="input-group">
            <label>Purpose: </label>
            <label class="input" ><?php echo $row1['purpose'];?></label>
          </div>
          <div class="input-group">
            <label>Mode Of Payment: </label>
            <label class="input" ><?php echo $row1['mop'];?></label>
          </div>
		<div class="input-group">
            <label>Reference Number: </label>
            <label class="input" ><?php echo $row1['ref'];?></label>
          </div>
          <div class="input-group">
            <label>Receipt: </label>
            <label class="input" ><?php echo $row1['receipt'];?></label>
           <input type="submit" name="view" id="view" value="View" class="receipt" />
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row1['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Document File: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
              <input type="submit" name="submit" value="Upload" class="btn" />
        </div>		
		<?php } ?>
		
		<?php if($row['docu_type']=='BUSINESS PERMIT'){ ?>
	
	<div class="input-group">
          <label>Transaction ID: </label>
          <label class="input" ><?php echo $row['trans_id'];?></label>
        </div>
        <div class="input-group">
          <label>Document Type: </label>
          <label class="input" ><?php echo $row['docu_type'];?></label>
        </div>
        <div class="input-group">
            <label>Cedula Number: </label>
            <label class="input" ><?php echo $row1['cedula_no'];?></label>
          </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row1['name'];?></label>
        </div>
		<div class="input-group">
            <label>Purpose: </label>
            <label class="input" ><?php echo $row1['business_name'];?></label>
          </div>
        <div class="input-group">
            <label>Zone Address: </label>
            <label class="input" ><?php echo $row1['zone_add'];?></label>
          </div>
          <div class="input-group">
            <label>Mode Of Payment: </label>
            <label class="input" ><?php echo $row1['mop'];?></label>
          </div>
		<div class="input-group">
            <label>Reference Number: </label>
            <label class="input" ><?php echo $row1['ref'];?></label>
          </div>
          <div class="input-group">
            <label>Receipt: </label>
            <label class="input" ><?php echo $row1['receipt'];?></label>
           <input type="submit" name="view" id="view" value="View" class="receipt" />
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row1['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Document File: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
              <input type="submit" name="submit" value="Upload" class="btn" />
        </div>	
		<?php } ?>
		
		<?php if($row['docu_type']=='BUILDING PERMIT'){ ?>
		<div class="input-group">
          <label>Transaction ID: </label>
          <label class="input" ><?php echo $row['trans_id'];?></label>
        </div>
        <div class="input-group">
          <label>Document Type: </label>
          <label class="input" ><?php echo $row['docu_type'];?></label>
        </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row1['name'];?></label>
        </div>
        <div class="input-group">
            <label>Zone Address: </label>
            <label class="input" ><?php echo $row1['zone_add'];?></label>
          </div>
          <div class="input-group">
            <label>Mode Of Payment: </label>
            <label class="input" ><?php echo $row1['mop'];?></label>
          </div>
		<div class="input-group">
            <label>Reference Number: </label>
            <label class="input" ><?php echo $row1['ref'];?></label>
          </div>
          <div class="input-group">
            <label>Receipt: </label>
            <label class="input" ><?php echo $row1['receipt'];?></label>
           <input type="submit" name="view" id="view" value="View" class="receipt" />
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row1['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Document File: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
              <input type="submit" name="submit" value="Upload" class="btn" />
        </div>	
		
		<?php } ?>
		
				<?php if($row['docu_type']=='CEDULA'){ ?>
		<div class="input-group">
          <label>Transaction ID: </label>
          <label class="input" ><?php echo $row['trans_id'];?></label>
        </div>
        <div class="input-group">
          <label>Document Type: </label>
          <label class="input" ><?php echo $row['docu_type'];?></label>
        </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row1['name'];?></label>
        </div>
        <div class="input-group">
            <label>Address: </label>
            <label class="input" ><?php echo $row1['address'];?></label>
          </div>
		<div class="input-group">
            <label>Contact Number: </label>
            <label class="input" ><?php echo $row1['contactno'];?></label>
          </div>
		<div class="input-group">
            <label>Citizenship: </label>
            <label class="input" ><?php echo $row1['citizenship'];?></label>
          </div>
		<div class="input-group">
            <label>Civil Status: </label>
            <label class="input" ><?php echo $row1['civil_status'];?></label>
          </div>
		<div class="input-group">
            <label>Birthdate: </label>
            <label class="input" ><?php echo $row1['birthdate'];?></label>
          </div>
		<div class="input-group">
            <label>Birthplace: </label>
            <label class="input" ><?php echo $row1['birthplace'];?></label>
          </div>
          <div class="input-group">
            <label>Mode Of Payment: </label>
            <label class="input" ><?php echo $row1['mop'];?></label>
          </div>
		<div class="input-group">
            <label>Reference Number: </label>
            <label class="input" ><?php echo $row1['ref'];?></label>
          </div>
          <div class="input-group">
            <label>Receipt: </label>
           <label class="input" ><?php echo $row1['receipt'];?></label>
           <input type="submit" name="view" id="view" value="View" class="receipt" />
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row1['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Document File: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
              <input type="submit" name="submit" value="Upload" class="btn" />
        </div>	
		
		<?php } ?>
		
       	<?php if($row['docu_type']=='RESIDENCY'){ ?>
		<div class="input-group">
          <label>Transaction ID: </label>
          <label class="input" ><?php echo $row['trans_id'];?></label>
        </div>
        <div class="input-group">
          <label>Document Type: </label>
          <label class="input" ><?php echo $row['docu_type'];?></label>
        </div>
        <div class="input-group">
          <label>Name: </label>
          <label class="input"><?php echo $row1['name'];?></label>
        </div>
        <div class="input-group">
            <label>Zone Address: </label>
            <label class="input" ><?php echo $row1['zone_add'];?></label>
          </div>
		<div class="input-group">
            <label>Years of Residency: </label>
            <label class="input" ><?php echo $row1['yrs_residency'];?></label>
		</div>
          <div class="input-group">
            <label>Mode Of Payment: </label>
            <label class="input" ><?php echo $row1['mop'];?></label>
          </div>
		<div class="input-group">
            <label>Reference Number: </label>
            <label class="input" ><?php echo $row1['ref'];?></label>
          </div>
          <div class="input-group">
            <label>Receipt: </label>
            <label class="input" ><?php echo $row1['receipt'];?></label>
           <input type="submit" name="view" id="view" value="View" class="receipt" />
          </div>
          <div class="input-group">
            <label>Appointment Date: </label>
            <label class="input" ><?php echo $row1['app_date'];?></label>
          </div>
        <div class="input-group">
            <label>Document File: </label>
              <input type="file" name="file" id="file"/>
          </div>
            <div class="btns">
             <input type="submit" name="submit" value="Upload" class="btn" />
        </div>	
		<?php } ?>
    </div>
</form>
</body>
</html>