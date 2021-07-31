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
	$start = $_POST['time1'];
	$end = $_POST['time2'];
	if ($end < $start){
	 echo "Service end time error: TRY AGAIN!";
	} else {
	 
	//}
	
	
	$staff = mysqli_real_escape_string($conn, $_SESSION['username']);
	$sn = $_POST['ser_name'];
	$ent = mysqli_real_escape_string($conn, $_POST['time1']);
	$ex = mysqli_real_escape_string($conn, $_POST['time2']);
	$entry_in_sec = strtotime($ent);
	$exit_in_sec = strtotime($ex);
	$service_time_in_sec=  ($exit_in_sec - $entry_in_sec);
	$service_time_in_min=($service_time_in_sec/60);
	//$service_time=date("H:i:s", $service_time_in_sec);
	$insert = mysqli_query($conn, "INSERT INTO servicelog (performed_By, name, C_entry_time, C_exit_time,service_time) 
	                             VALUES ('$staff','$sn','$ent','$ex','$service_time_in_min')");
	// if($insert){
		// echo '<script>
			// alert("Service Completed!");
			// window.location.href="viewCustomerAppointments.php";
			// </script>';
        // echo '<div class="container py-2 mt-2">
        // <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
        // <div class="p-3 mb-2 bg-success text-white">Successfully added new record!</div>
      // </div>
      // </div>';
        
	// } else {
        // echo '<div class="container py-2 mt-2">
        // <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
        // <div class="p-3 mb-2 bg-warning text-white">Failed to add new service because'.mysqli_error($conn);'</div>
      // </div>
      // </div>';
	// }
	
	$updatequery = "SELECT * FROM available_services WHERE name='$sn' ";
	$updateresult = mysqli_query($conn, $updatequery);
	while($row = mysqli_fetch_array($updateresult)){
		echo "Current service time: ".$row[4];
		$average = (($row[4] + $service_time_in_min)/2);
		echo $average;
		$insertaverage = "UPDATE available_services SET time='$average' WHERE name='$sn' ";
		$insertavgresult = mysqli_query($conn, $insertaverage);
		// if ($insertavgresult){
			// echo '<script>
			// alert("Service Completed!");
			// window.location.href="viewCustomerAppointments.php";
			// </script>';
		// } else {
			// echo "Fail to update";
		// }
	}
	
	$appoi_id = $_POST['appoiID'];
	$delete_appointment = mysqli_query($conn, "DELETE FROM active_appointments WHERE appoi_ID='$appoi_id'");
	if ($delete_appointment){
			echo '<script>
			alert("Service Completed!");
			window.location.href="viewCustomerAppointments.php";
			</script>';
		} else {
			echo "Fail to update";
		}
	}
	}
 }




?>
<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
<div class="form-label-group" >  
  <label for="staffNo">Appointment ID:</label>
  <select name="appoiID">
	<option>
     <?php echo $_REQUEST['pn']; ?>
	 </option>
	</select>
    </div>
	<?php
	$A_ID = $_REQUEST['pn'];
	$startquery = "SELECT * FROM active_appointments WHERE appoi_ID='$A_ID' ";
	$startresult = mysqli_query($conn, $startquery);
	while($row = mysqli_fetch_array($startresult)){
	echo '</br>';
	echo '<label for="staffNo">Customer Name:  </label>';
	echo "  ".$row[1];
	echo '</br>'; ?>
	
	<label for="staffNo">Service name:  </label>
	<select name="ser_name">
	<option>
	<?php
	echo $row[2];
	?>
	</option>
	</select>
	
	<?php
	echo '</br>';
	echo '<label for="staffNo">Appointment supposed start time:  </label>';
	echo "  ".$row[3];
	echo '</br>';
	echo '<label for="staffNo">Appointment estimated end time:  </label>';
	echo "  ".$row[4];
	}
	?>
	<div class="form-label-group">
    <label for="fName :">Customer Entry Time:</label>
     <input type="time" name="time1"  id="time1" min="09:00:00" max="17:00:00" required="required" data-error="Please enter Time">
    </div>
	<div class="form-label-group">
    <label for="fName :">Customer Exit Time:</label>
     <input type="time" name="time2"  id="time2" min="09:00:00" max="17:00:00" required="required" data-error="Please enter Time">
    </div>

            <input class="btn btn-success" onmousedown="move.play()" value="Submit" name="submit" type="submit">
            </div> </form>
</div>
</div>

</body>