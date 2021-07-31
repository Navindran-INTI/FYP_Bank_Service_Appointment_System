<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'appointment_system');

$name = $_POST['user'];
$pass = $_POST['password'];
$type = $_POST['usertype'];
$email = $_POST['email'];

$s = "select * from users where name = '$name'";
$result= mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if ($num == 1){
	echo '<script>
			alert("Username already taken!");
			window.location.href="register_staff.php";
			</script>';
}else{
	$reg="insert into users(name,email,password,usertype) values ('$name','$email','$pass','staff')";
	mysqli_query($con,$reg);
	echo '<script>
			alert("Successfully registered!");
			window.location.href="register_staff.php";
			</script>';
}

?>