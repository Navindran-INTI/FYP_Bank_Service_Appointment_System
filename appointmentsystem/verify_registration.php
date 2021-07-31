<?php
session_start();

$con = mysqli_connect('localhost','root','');
mysqli_select_db($con, 'appointment_system');

$name = $_POST['user'];
$pass = $_POST['password'];
//$type = $_POST['usertype'];
$email = $_POST['email'];

$s = "select * from users where name = '$name'";
$result= mysqli_query($con, $s);

$num = mysqli_num_rows($result);

if ($num == 1){
	echo '<script>
			alert("Username already taken!");
			window.location.href="register.php";
			</script>';
}else{
	$reg="insert into users(name,email,password,usertype) values ('$name','$email','$pass','user')";
	mysqli_query($con,$reg);
	
			// the message
			$msg = "Welcome to Appointment System\nVery mucha pleasure to have you";
			
			// use wordwrap() if lines are longer than 70 characters
			$msg = wordwrap($msg,70);

			// send email
			mail($email,"Application System",$msg);
			
	echo '<script>
			alert("Successfully registered!");
		
			window.location.href="login.php";
			</script>';
}

?>