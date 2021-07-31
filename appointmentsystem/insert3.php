<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");
$time1 = "2021-07-23 12:54:00";
$time2 = "2021-07-23 12:59:00";
$timequery = "SELECT * FROM active_appointments WHERE (end_time<'$time1' AND start_time>'$time1') OR (end_time<'$time2' AND start_time>'$time2')";
$timeresult = mysqli_query($conn, $timequery);
$rowcount=mysqli_num_rows($timeresult);
  echo "Result set has".$rowcount;
  
  if($rowcount != 0){
	  echo "Time clashing!";
  }
?>