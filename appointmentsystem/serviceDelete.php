<?php
session_start();

	if(!isset($_SESSION['username'])){
			header('location:homepage.php');
		
	}
	
   if( isset( $_SESSION['counter'] ) ) {
      $_SESSION['counter'] += 1;
	  
   }else {
      $_SESSION['counter'] = 1;
   }
	
   $msg = "You have visited this page ".  $_SESSION['counter'];
   $msg .= " times this session.";
   
?>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<script>
var bleep = new Audio();
bleep.src = "click/success.mp3";
var boop = new Audio();
boop.src = "click/regress.mp3";
var del = new Audio();
del.src = "click/delete.mp3";
var edit = new Audio();
edit.src = "click/edit.mp3";
var sub1 = new Audio();
sub1.src = "click/submit.mp3";
var sub2 = new Audio();
sub2.src = "click/submit2.mp3";
var back = new Audio();
back.src = "click/back.mp3";
var move = new Audio();
move.src = "click/move.mp3";
var moveback = new Audio();
moveback.src = "click/moveback.mp3";
</script><script>
function tostafflist() {
  window.location.assign("register_staff.php")
}
function toservicelist() {
  window.location.assign("service_list.php")
}
function toPerformService() {
  window.location.assign("startService.php")
}
function toActiveAppointments() {
  window.location.assign("viewCustomerAppointments.php")
}
</script>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css">
<div class="w3-bar w3-white w3-card" id="myNavbar">
<a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button w3-wide"><img src="img/logo.png" style="width:10em; "/></a>
	<h1>Bank Service Appointment System</h1>
	<h2>Staff Homepage</h2>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	 <p>Hi, <?php echo $_SESSION['username']." ".$msg ;?></p>
	  <a href="logout.php" onmousedown="bleep.play()">LOGOUT</a>
      <a href="#about" onclick="tostafflist()" onmousedown="bleep.play()" class="w3-bar-item w3-button">STAFF REGISTRY</a>
      <a href="#work"  onclick="toservicelist()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-th"></i> SERVICE LIST</a>
      <a href="#contact" onclick="toActiveAppointments()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> ACTIVE APPOINTMENTS</a>
    </div>
	</div>
<body>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");

if(isset($_POST['delete'])){
	$delete = mysqli_query($conn, "DELETE FROM available_services WHERE id='{$_POST['pn']}'");
	
	if($delete){
		echo '<script>
			alert("Successfully deleted service!");
			window.location.href="service_list.php";
			</script>';

		exit();
	} else {
		//echo 'Failed to delete record because '.mysqli_error($conn);
		echo '<div class="container py-2 mt-2 mb-5">
        <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
		<div class="p-3 mb-2 bg-danger text-white">Failed to delete record because '.mysqli_error($conn);'</div>
      </div>
      </div>';
	}
}
?>
<html lang="en">
<head>
  <title></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
<input type="hidden" value="<?php echo $_REQUEST['pn'];  ?>" name="pn">

<div>
		<b>
<table><table style="width:30%">
<tr>
	<td class="display-4">Are you sure you want to <b>delete?<b> </td>
    <td><input type="submit" name="delete" value="Yes"  class="btn btn-danger" onmousedown="back.play()"></td>
	<br/>
	<br/>
	<td><input class="btn btn-warning" type="button" value="Cancel" onmousedown="moveback.play()" onclick="window.location='service_list.php'"></td>
</tr>
</table>
	</b>
	</div>
</form>