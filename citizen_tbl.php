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

$sql="select * from citizen_tbl";
$res=mysqli_query($con,$sql);

if(isset($_POST['submit'])){
	$search = $_POST['search'];	
	$sql="select * from citizen_tbl where name LIKE '".$search."%'";
	$res=mysqli_query($con,$sql);
}

if(isset($_POST['filter'])){
	$search = $_POST['sex'];	
	$sql="select * from citizen_tbl where sex='$search'";
	$res=mysqli_query($con,$sql);
}

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['id']);
		$delete_sql="delete from citizen_tbl where id='$id'";
		mysqli_query($con,$delete_sql);		
	}
	$sql="select * from citizen_tbl";
	$res=mysqli_query($con,$sql);
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Citizen Database</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="citizen_tbl.css">
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
            <h2 class="text-center">CITIZEN DATABASE</h2>
		<hr>
		<p><a href="add_citizen.php">ADD CITIZEN</a></p>
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
                    <select class="type" name="sex" id="sex">
						<option>Select Sex</option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                <input type="submit" name="filter" value="Filter" class="filter-btn" />
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
                            <th>ID</th>
							<th>Name</th>
                            <th>Age</th>
							<th>Zone Address</th>
							<th>Email</th>
							<th>Contact Number</th>
                            <th>Sex</th>
							<th width="26%"></th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
							 $i=1;
							while($row=mysqli_fetch_assoc($res)){ ?>
							<tr>
							   <td><?php echo $row['id']?></td>
							   <td><?php echo $row['name']?></td>
							   <td><?php echo $row['age']?></td>
							   <td><?php echo $row['zone_add']?></td>
								<td><?php echo $row['email']?></td>
								<td><?php echo $row['contactno']?></td>
								<td><?php echo $row['sex']?></td>
								<td><?php 
								echo "<span class='four'><a href='update_citizen.php?id=".$row['id']."' class ='four'>UPDATE</a></span>&nbsp;";
								echo "<span class='five'><a href='?type=delete&id=".$row['id']."' class ='five'>DELETE</a></span>";							
									?></td>
							</tr>						
							<?php } ?>
                    </tbody>
                </table>
        </div>
    </div>

</body>
</html>