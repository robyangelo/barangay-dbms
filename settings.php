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

$sql="select * from app_sched order by app_sched";
$res=mysqli_query($con,$sql);

$sql1="select * from mop order by mop";
$res1=mysqli_query($con,$sql1);

if(isset($_GET['type']) && $_GET['type']!=''){
	$type=get_safe_value($con,$_GET['type']);
	
	
	if($type=='delete'){
		$id=get_safe_value($con,$_GET['app_sched']);
		$delete_sql="delete from app_sched where app_sched='$id'";
		mysqli_query($con,$delete_sql);
	
		$sql="select * from app_sched order by app_sched";
$res=mysqli_query($con,$sql);
		$sql1="select * from mop order by mop";
$res1=mysqli_query($con,$sql1);
		
	}
	elseif ($type=='delete1'){
		$id=get_safe_value($con,$_GET['mop']);
		$delete_sql="delete from mop where mop='$id'";
		mysqli_query($con,$delete_sql);
	
		$sql="select * from app_sched order by app_sched";
$res=mysqli_query($con,$sql);
		$sql1="select * from mop order by mop";
$res1=mysqli_query($con,$sql1);
		
	}

}
if(isset($_POST['submit'])){
	$app_sched=$_POST['app_sched'];
	
		$sql1 = "insert into app_sched(app_sched) values('$app_sched')";
			mysqli_query($con, $sql1);
	
	$sql="select * from app_sched order by app_sched";
$res=mysqli_query($con,$sql);
	
}
elseif(isset($_POST['submit1'])){
	$mop=$_POST['mop'];
	
		$sql = "insert into mop(mop) values('$mop')";
			mysqli_query($con, $sql);
	
	$sql1="select * from mop order by mop";
$res1=mysqli_query($con,$sql1);
		
	
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="with=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="settings.css">
	

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
<form method="post"  action = "" >
    <div class="main_content">
            <h2 class="text-center">ADMIN SETTINGS</h2>
		<hr>
            <p>CHANGE SETTINGS</p>
		
         
		<div class="table-container">
        <div class="content_table">
			<div class="input-group">
				<div class="wrap1">
                    <div class="inputdate">
          <input type="text" name="app_sched" id="app_sched" placeholder="Input Date" class="inputterm"/>
		<input type="submit" value="ADD" name="submit" class="input-btn"/>
        </div>
				</div>
			</div>
                <table>
                    <thead>
                        <tr>
                            <th>Appointment Schedule</th>
                            <th width="26%"></th>
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
							 $i=1;
							while($row=mysqli_fetch_assoc($res)){?>
							<tr>
							   <td><?php echo $row['app_sched']?></td>
							
															
								   </td>
							  
							 <td><?php
					echo "<span class='five'><a href='?type=delete&app_sched=".$row['app_sched']."' class ='five'>DELETE</a></span>";?>
					</td>
							</tr>
							 

							<?php } ?>
                    </tbody>
                </table>
	
	
	
        </div>
	
	
		
	  <div class="content_table">
		  <div class="input-group">
			  <div class="wrap2">
            <div class="inputmode">
          <input type="text" name="mop" id="mop" placeholder="Input Mode of Payment" class="modeterm"/>
		<input type="submit" value="ADD" name="submit1" class="mode-btn"/>
        </div>
			  </div>
		  </div>
                <table>
                    <thead>
                        <tr>
                            <th>Mode of Payment</th>
                            <th width="26%"></th>
							
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
							 $i=1;
							while($row=mysqli_fetch_assoc($res1)){?>
							<tr>
							   <td><?php echo $row['mop']?></td>
							
															
								   </td>
							  
							 <td><?php
					echo "<span class='five'><a href='?type=delete1&mop=".$row['mop']."' class ='five'>DELETE</a></span>";?>
					</td>
							</tr>
							 

							<?php } ?>
                    </tbody>
                </table>
	
	
	</div>
        </div>
    </div>
</form>
</body>
</html>