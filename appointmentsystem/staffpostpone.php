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
<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");


if(isset($_POST['submit'])){
	$date = mysqli_real_escape_string($conn, $_POST['date']);
	$time = mysqli_real_escape_string($conn, $_POST['time']);
	
	$update = mysqli_query($conn, "UPDATE active_appointments SET date='$date', time='$time'  WHERE appoi_ID='{$_POST['id']}'");
	if($update){
    echo '<script>
			alert("Successfully updated appointment!");
			window.location.href="viewCustomerAppointments.php";
			</script>';
    echo '<div class="container py-2 mt-2">
    <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
    <div class="p-3 mb-2 bg-success text-white">Successfully edit record !</div>
  </div>
  </div>';
    
	} else {
		echo 'Failed to postpone because '.mysqli_error($conn);
	}
}




$query = mysqli_query($conn, "SELECT * FROM active_appointments WHERE appoi_ID='{$_REQUEST['pn']}' ");
while($row = mysqli_fetch_array($query)){	
	$jn = $row['services_requested'];
	//$jst = $row['description'];
	$jd = $row['date'];
	$jt = $row['time'];
	
}
?>
<body>

<section class=" py-3 mt-3 ">

</section>
	<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	 <div class="container center_div mb-3">
    <div class="row rwdown">
      <div class="col-sm-15 col-md-7 col-lg-18 mx-auto">
        <div class="card card-signin my-0">
          <div class="card-body">
              <h5 class="card-title text-center"></h5>	
     <input type="hidden" value="<?php echo $_REQUEST['pn']; ?>" name="id" >
	<div class="form-label-group" >  
  <label for="staffNo">Appointment ID:</label>
     <select class="input-group2" name="serviceName">
		<option> <?php echo $_REQUEST['pn'] ?> </option>	
	
	 </select>
    </div>
	<div class="form-label-group" >  
  <label for="staffNo">Service Name:</label>
     <input type="text" name="ser_name" class="form-control form-control-lg mb-2" id="ser_name" value="<?php echo $jn; ?>" required="required" disabled>
    </div>
	<!--<tr> 
    <td>Service Time(min):</td>
    <td><input class="form-control form-control-lg mb-2" type="number" name="time" value="" disabled></td>
  </tr> --> 
	<div class="form-label-group" >  
  <label for="staffNo">Choose a Date:</label>
     <input type="date" name="date" class="form-control form-control-lg mb-2" id="date" value="<?php echo $jd; ?>" required="required" data-error="Please Enter Date.">
    </div>
			  
	<div class="form-label-group">
    <label for="fName :">Choose a time(Between 9am and 5pm):</label>
     <input type="time" name="time" class="form-control form-control-lg mb-2" id="time" value="<?php echo $jt; ?>" required="required" data-error="Please enter Time">
    </div>
	
	
	
  </select>
     <div class="form-group text-center mb-3">
            <input class="btn btn-secondary btn-block btn-lg" onmousedown="move.play()" name="submit" type="submit">
            </div>
    </ul>
</div></div>

</body>