<?php
require('connection.inc.php');
if(!isset($_SESSION['username'])){
    header('location:login.php');
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

$sql="select * from request_tbl order by status, app_date";
$res=mysqli_query($con,$sql);

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	if($type=='status'){
		$operation=get_safe_value($con,$_GET['operation']);
		$id=get_safe_value($con,$_GET['id']);
		if($operation=='complete'){
			$status='0';
		}elseif ($operation=='deactive'){
			$status='1';
		}
		else{
			$status='2';
		}
		$update_status_sql="update request_tbl set status='$status' where trans_id='$id'";
		mysqli_query($con,$update_status_sql);
	}
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['trans_id']);
		$delete_sql="delete from request_tbl where trans_id='$id'";
		mysqli_query($con,$delete_sql);	
	
	
	}

$sql="select * from request_tbl order by status, app_date";
$res=mysqli_query($con,$sql);
}

if(isset($_POST['submit'])){
	$search = $_POST['search'];	
	$sql="select * from request_tbl where name LIKE '".$search."%'";
	$res=mysqli_query($con,$sql);
	
	if ($res) {
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

if(isset($_POST['filter'])){
	$filter = $_POST['docu_type'];	
	$sql="select * from request_tbl where docu_type='$filter'";
	$res=mysqli_query($con,$sql);
}

if(isset($_POST['filter1'])){
	$filter = $_POST['app_date'];	
	$sql="select * from request_tbl where app_date='$filter'";
	$res=mysqli_query($con,$sql);
}

if(isset($_POST['view'])){
	$sql="select * from off_trans order by name";
	$res=mysqli_query($con,$sql);
}
if(isset($_POST['view1'])){
	$sql="select * from requestreject_tbl order by name";
	$res=mysqli_query($con,$sql);
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Certificate Requests</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="admin_tbl.css">
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
            <h2 class="text-center">CERTIFICATE REQUESTS</h2>
		<hr>
		<p><a href="offline_request.php">ADD REQUEST</a></p>
		<form method="post"  action = "" >
            <div class="options">
                <div class="wrap">
                <div class="search-btn">
                    <input type="text" class="searchTerm" name="search" id="search" placeholder="Search">
                    
					<input type="submit" name="submit" value="Search" class="searchButton" />
                </div>
            </div>
                 	
            <div class="wrap-ni-filter2">
                <div class="filter2">
                    <select class="type" name="docu_type" id="docu_type">
                        <option>Select Document Type</option>
                        <option >CLEARANCE</option>
                        <option >BUSINESS PERMIT</option>
                        <option >BUILDING PERMIT</option>
						<option >CEDULA</option>
						<option >CERTIFICATE OF RESIDENCY</option>
                      </select>
                <input type="submit" class="filter-btn" name="filter" id="filter" value="Filter">
            </div>
        </div>
					   <div class="wrap-ni-filter3">
            <div class="filter3">
                <input type="submit" name="view" id="view" class="view-btn" value="View Offline Transactions">
            </div>
        </div>
				 <div class="wrap-ni-filter5">
            <div class="filter5">
                <input type="submit" name="view1" id="view1" class="view-btn1" value="View Rejected Transactions">
            </div>
        </div>
        <div class="wrap-ni-filter4">
            <div class="filter4">
                <button class="refresh-btn" onClick="window.location.reload();"><i class='bx bx-refresh'></i></button>
            </div>
        </div>
       </div>
	</form>
        <div class="content_table">
                <table>
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
							<th>Name</th>
                            <th>Document Type</th>
                            <th>Appointment Date</th>
                            <th width="26%"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['trans_id']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['docu_type']?></td>
							   <td><?php echo $row['app_date'];?></td>
							  
							   <td>
								<?php
								if($row['status']==0){
									echo "<span class='one'><a href='?type=status&operation=deactive&id=".$row['trans_id']."' class='one'>APPROVE</a></span>&nbsp;";
									echo "<span class='four'><a href='view_cert.php?trans_id=".$row['trans_id']."' class ='four'>VIEW DETAILS</a></span>&nbsp;";
									echo "<span class='five'><a href='?type=delete&trans_id=".$row['trans_id']."' class ='five'>REJECT</a></span>";
								}elseif ($row['status']==1){
									echo "<span class='two'><a href='?type=status&operation=pending&id=".$row['trans_id']."' class='two'>PENDING</a></span>&nbsp;";
									echo "<span class='four'><a href='view_cert.php?trans_id=".$row['trans_id']."' class ='four'>VIEW DETAILS</a></span>&nbsp;";
									echo "<span class='five'><a href='?type=delete&trans_id=".$row['trans_id']."' class ='five'>REJECT</a></span>";
								}
								elseif ($row['status']==2){
									echo "<span class='three'><a href='?type=status&operation=complete&id=".$row['trans_id']."' class='three'>COMPLETED</a></span>&nbsp;";
									echo "<span class='four'><a href='view_cert.php?trans_id=".$row['trans_id']."' class ='four'>VIEW DETAILS</a></span>&nbsp;";
									echo "<span class='five'><a href='?type=delete&trans_id=".$row['trans_id']."' class ='five'>REJECT</a></span>";
								}
								elseif ($row['status']==4){
									echo "<span class='three'><a href='#' class='three'>COMPLETED</a></span>&nbsp;";
								}								 
								else {
									
									echo "<span class='five'><a href='#' class ='five'>REJECTED</a></span>&nbsp;";
								}
																 
								?>
							   </td>
							</tr>
							<?php } ?>
                    </tbody>
                </table>
        </div>
    </div>

</body>
</html>