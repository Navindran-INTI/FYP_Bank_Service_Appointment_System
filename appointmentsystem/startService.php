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
      <a href="#pricing" onclick="toPerformService()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-usd"></i>START SERVICE</a>
      <a href="#contact" onclick="toActiveAppointments()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i> ACTIVE APPOINTMENTS</a>
    </div>
	</div>
<body>


</br>
</br>
<!--<div class="card card-signin my-0">
          <div class="card-body">
<div class="form-group text-center mb-3">
<form action="" method="POST">
    <button name="click" class="btn btn-info" onmousedown="move.play()" class="click" >Record Customer Entry</button> -->
	<?php
	// $today = date("Y/m/d");
	// $today_in_sec = strtotime($today);
	// $real_day_in_sec= $today_in_sec + 86400;
	// $realtoday=date("Y-m-d", $real_day_in_sec);
	// echo $realtoday;
// if(isset($_POST['click']))
// {
	// $time_clicked1 = date('H:i:s');
	// $time_clicked1 = date('');
    // echo "Entry Time: " . $time_clicked1 . "<br>";
// }
$conn = mysqli_connect("localhost", "root", "");
$db =mysqli_select_db($conn, "appointment_system");


// echo $realtoday;
// ?>
 <!--</form>
// <div class="form-label-group" >
// <label for="staffNo">Customer ID:</label>
// <form>-->


<?php
// echo "<form>";
// $sql = "SELECT DISTINCT requested_By FROM active_appointments";
// $result = mysqli_query($conn, $sql);

// echo "<select name='customerID'>";
// while ($row = mysqli_fetch_array($result)) {
    // echo "<option value='".$row[0]."'>".$row[0]."</option>";
// }
// echo "</select>";
// echo "</form>";

// ?>


</select>
</form>
</div>

<?php

if(isset($_POST['submit'])){{
	
	
	
	$staff = mysqli_real_escape_string($conn, $_SESSION['username']);
	$sn = mysqli_real_escape_string($conn, $_POST['name']);
	$ent = mysqli_real_escape_string($conn, $_POST['time1']);
	$ex = mysqli_real_escape_string($conn, $_POST['time2']);
	$entry_in_sec = strtotime($ent);
	$exit_in_sec = strtotime($ex);
	$service_time_in_sec=  ($exit_in_sec - $entry_in_sec);
	$service_time_in_min=($service_time_in_sec/60);
	//$service_time=date("H:i:s", $service_time_in_sec);
	$insert = mysqli_query($conn, "INSERT INTO servicelog (performed_By, name, C_entry_time, C_exit_time,service_time) 
	                             VALUES ('$staff','$sn','$ent','$ex','$service_time_in_min')");
	if($insert){
		echo '<script>
			alert("Service Completed!");
			<a href="predict.php?pn=<?php echo $service_time;?>">;
			</script>';
        echo '<div class="container py-2 mt-2">
        <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
        <div class="p-3 mb-2 bg-success text-white">Successfully added new record!</div>
      </div>
      </div>';
        
	} else {
        echo '<div class="container py-2 mt-2">
        <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
        <div class="p-3 mb-2 bg-warning text-white">Failed to add new service because'.mysqli_error($conn);'</div>
      </div>
      </div>';
	}
}
 }




?>
<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
<div class="form-label-group" >  
  <label for="staffNo">Service Name:</label>
     <input type="text" name="name" class="form-control form-control-lg mb-2" id="name" placeholder="Enter Service Name" required="required" data-error="Please Enter New Service Name.">
    </div>
	<div class="form-label-group">
    <label for="fName :">Customer Entry Time:</label>
     <input type="time" name="time1" class="form-control form-control-lg mb-2" id="time1"  required="required" data-error="Please enter Time">
    </div>
	<div class="form-label-group">
    <label for="fName :">Customer Exit Time:</label>
     <input type="time" name="time2" class="form-control form-control-lg mb-2" id="time2"  required="required" data-error="Please enter Time">
    </div>

            <input class="btn btn-success" onmousedown="move.play()" value="Submit" name="submit" type="submit">
            </div> </form>
</div>
</div>

</body>
