<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'appointment_system');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = "select * from users where name = '$name' && password='$pass'";
$result= mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if ($num == 1){
	$result=mysqli_fetch_array($result);
	$role = $result['usertype'];
	$_SESSION['username'] = $name;
	$_SESSION['password'] = $pass;
	$_SESSION['role'] = $role;
	if($role =='user'){
	$link = 'userhomepage.php';
	}
	else if($role =='staff'){
	$link = 'staffhomepage.php';
	}
	header("location: ".$link."");
	// $_SESSION['username'] = $name;
	// header('location:homepage.php');
}else{
	echo '<script>
			alert("Username or password invalid!");
			window.location.href="register.php";
			</script>';
	
}

?>