<?php
session_start();
if(isset($_POST['submit'])){
	$username = $_POST['username'];	
	$password = $_POST['password'];	
	if($username=='admin' && $password=='admin'){
		 $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            header('location:dashboard.php'); 
            exit();
	}else{
		echo '<script>alert("Invalid input! Incorrect username or password.")</script>';
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
    <title>Admin Login</title>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">

</head>


<form action="" class="login-form" method="post">
    <h1 class="text-center">ADMIN</h1>
	<hr>
	<p>LOGIN</p>
<br>
    <div class="input_group">
        <label for="username">Username: </label>
        <input type="text" id="username" name="username">
    </div>

    <div class="input_group">
        <label for="password">Password: </label>
        <input type="password" id="password" name="password">
    </div>

    <input type="submit"  name="submit" id="submit" class="logbtn" value="Login">


  </form>
