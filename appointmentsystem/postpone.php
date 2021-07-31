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
<script>
function viewAppointments(){
	window.location.assign("viewAppointments.php")
}
function viewUserHome(){
	window.location.assign("userhomepage.php")
}
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css">

<<body>
	<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button w3-wide"><img src="img/logo.png" style="width:10em; "/></a>
	<h1>Bank Service Appointment System</h1>
	<h2>User Homepage</h2>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	 <p>Hi, <?php echo $_SESSION['username']." ".$msg ;?></p>
	  <a href="logout.php" onmousedown="bleep.play()">LOGOUT</a>
      <a href="#about" onclick="viewUserHome()" class="w3-bar-item w3-button">MyInfo</a>
      <a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-th"></i>SERVICES OFFERED</a>
      <a  onclick="viewAppointments()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-usd"></i>VIEW APPOINTMENTS</a>
      
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>
<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");


if(isset($_POST['submit'])){
	$dis = strtotime($_POST['date']);
	$td =  date("Y-m-d");
	$t_s = strtotime($td);
	$d2 = $dis - $t_s;
	$sq = strtotime ($_POST['time']);
	$pdate = $sq + $d2;
	$sss = date("Y-m-d H:i:s",$pdate);
	
	$tm = $_REQUEST['serviceTime'];
	$time_sec = $tm * 60;
	$ser_end_time= $pdate + $time_sec;
	$estim = date("Y-m-d H:i:s", $ser_end_time);
	
	$estim_date = date("Y-m-d 17:00:00", $ser_end_time);
	$td_close = date("Y-m-d 15:00:00");
	
	if($estim > $estim_date){
		echo '<script>
			alert("Past the closing hours! Please choose a later day.");
			window.location.href="viewAppointments.php";
			</script>';
		//echo "Past the closing hours! Please choose a later day.";
	}else {
	$time1 = $sss;
	$time2 = $estim;

	$overlap = "SELECT * FROM active_appointments WHERE (end_time >'$time1'  AND  start_time < '$time1') 
				OR
				(end_time >'$time2'  AND  start_time < '$time2')"; 
							
	$overlapres = mysqli_query($conn, $overlap);
	$count=mysqli_num_rows($overlapres);
		//echo "Count:".$count;
		echo '</br></br>';
		if($count != 0){
		echo '<script>
			alert("Time clashing! Choose another time");
			window.location.href="viewAppointments.php";
			</script>';
		}else{
			$d = strtotime($_POST['date']);
	$today =  date("Y-m-d");
	$t_i_s = strtotime($today);
	$d1 = $d - $t_i_s;
	$s = strtotime ($_POST['time']);
	$properdate = $s + $d1;
	$s1 = date("Y-m-d H:i:s",$properdate);
	$time = $_POST['serviceTime'];
	$timeinsec = $time * 60;
	$service_end_time= $properdate + $timeinsec;
	$est = date("Y-m-d H:i:s", $service_end_time);
	// $date = mysqli_real_escape_string($conn, $_POST['date']);
	// $time = mysqli_real_escape_string($conn, $_POST['time']);
	
	$update = mysqli_query($conn, "UPDATE active_appointments SET start_time='$s1', end_time='$est'  WHERE appoi_ID='{$_POST['id']}'");
	 if($update){
    echo '<script>
			alert("Successfully updated appointment!");
			window.location.href="viewAppointments.php";
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
	}

}


$query = mysqli_query($conn, "SELECT * FROM active_appointments WHERE appoi_ID='{$_REQUEST['pn']}' ");
while($row = mysqli_fetch_array($query)){	
	$initial_dt = strtotime($row['start_time']);
	$in_d = date("Y-m-d", $initial_dt);
	$in_t = date("H:i:s", $initial_dt);
	$jd = $in_d;
	$jt = $in_t;
	
}
?>

<body>
<div class="w3-center jobdiv" style="padding:250px 16px">
<section class=" py-3 mt-3 ">

</section>
	<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	 <div class="container center_div mb-3">
    <div class="row rwdown">
      <div class="col-sm-15 col-md-7 col-lg-18 mx-auto">
        <div class="card card-signin my-0">
          <div class="card-body">
              <h5 class="card-title text-center"></h5>	
             
	<div class="form-label-group" >  
  <label for="staffNo">Appointment ID:</label>
     <select class="input-group2" name="id">
		<option> <?php echo $_REQUEST['pn'] ?> </option>	
	
	 </select>
    </div>
	
	
	
	<div class="form-label-group" >  
  <label for="staffNo">Estimated Service Time:</label>
     <select class="input-group2" name="serviceTime">
		<option> <?php
				$apID = $_REQUEST['pn'];
				$query1= "SELECT * FROM available_services,active_appointments WHERE name=services_requested AND appoi_ID='$apID' ";
				$result1= mysqli_query($conn, $query1);
				while ($row1 = mysqli_fetch_array($result1)){
					echo $row1[4];
				}
		?> </option>	
	
	 </select>
    </div>
	
	<div class="form-label-group" >  
  <label for="staffNo">Service name:</label>
     <select class="input-group2" name="name">
		<option> <?php 
				$a_ID = $_REQUEST['pn'];
				$query2= "SELECT * FROM available_services,active_appointments WHERE name=services_requested AND appoi_ID='$a_ID' ";
				$result2= mysqli_query($conn, $query2);
		
				while ($row2 = mysqli_fetch_array($result2)){
					echo $row2[1];
				} 
				?> </option>	
	
	 </select>
    </div>
	
	<div class="form-label-group" >  
  <label for="staffNo">Choose a Date:</label>
     <input type="date" name="date" class="form-control form-control-lg mb-2" id="date" min="<?php echo date('Y-m-d',strtotime('+1 day'));?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" value="<?php echo $jd; ?>" required  data-error="Please Enter Date.">
    </div>
	<script>
const picker = document.getElementById('date');
picker.addEventListener('input', function(e){
  var day = new Date(this.value).getUTCDay();
  if([6,0].includes(day)){
    e.preventDefault();
    this.value = '';
    alert('Weekends not allowed');
  }
});

</script>
	<div class="form-label-group" >  
  <label for="staffNo">Choose a Time:</label>
     <input type="time" name="time" class="form-control form-control-lg mb-2" id="datetime" min="09:00:00" max="17:00:00" value="<?php echo $jt; ?>" required  data-error="Please Enter Date.">
    </div>
	
	
	
	
  </select>
     <div class="form-group text-center mb-3">
            <input class="btn btn-secondary btn-block btn-lg" onmousedown="move.play()" name="submit" type="submit">
            </div>
    </ul>
	<?php
		$schedule = "SELECT * FROM active_appointments,available_services where services_requested=name";
		$scheduleresult= mysqli_query($conn, $schedule);
		 echo '<div class="container" text-align="center" style="background-color:#A43144"> 
<div class="row">
<div class="col">
    <div class="card">
    <div class="card-header">
<table border="3" class="jobtable">
<thead class="thead-dark">
<tr style="background-color:#A43144">
<h2>Appointment Schedule</h2>
<th>START TIME</th>
<th>END TIME</th>

</tr></div></div></div></div></div>';
while($row = mysqli_fetch_array($scheduleresult)){
    echo '<div class="container mb-3"> 
    <div class="row" >
    <div class="col">
    <div class="card">

    <thead class="thead-dark"><tr border="5" style="background-color:#ADD8E6">';
	
        
		echo '<td >'.$row[3].'</td>' ;
		echo '<td >'.$row[4].'</td>' ;
		
		echo '</tr>
        </div></div></div></div>';
		
		
}
echo '</table>';
	?>
</div></div>
</div>
</div>
</div>
</div>
</body>