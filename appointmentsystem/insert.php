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
?>
<head>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css">

<body>


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
</script>
<script>
function viewServices(){
	window.location.assign("service_list.php")
}
var today = new Date();
var birthday = new Date('December 17, 1995 03:24:00');
var birthday = new Date('1995-12-17T03:24:00');
var birthday = new Date(1995, 11, 17);
var birthday = new Date(1995, 11, 17, 3, 24, 0);
var unixTimestamp = Date.now();
</script>
</head>
<?php
    // $dis = strtotime($_POST['date']);
	// $td =  date("Y-m-d");
	// $t_s = strtotime($td);
	// $d2 = $dis - $t_s;
	// $sq = strtotime ($_POST['time']);
	// $pdate = $sq + $d2;
	// $sss = date("Y-m-d H:i:s",$pdate);
	
// $query = "SELECT * FROM active_appointments";
// $show = mysqli_query($conn, $query);
// while($row = mysqli_fetch_array($show)){
	// echo $row[3];
	// echo '</br>';
	// echo $row[4];
	// echo '</br>';
	// echo "Appointment start date".$sss;
// }


if(isset($_POST['submit'])){
	
	    $dis = strtotime($_POST['date']);
	$td =  date("Y-m-d");
	$t_s = strtotime($td);
	$d2 = $dis - $t_s;
	$sq = strtotime ($_POST['time']);
	$pdate = $sq + $d2;
	$sss = date("Y-m-d H:i:s",$pdate);
	
	$tm = 55;
	$time_sec = $tm * 60;
	$ser_end_time= $pdate + $time_sec;
	$estim = date("Y-m-d H:i:s", $ser_end_time);
	
$query = "SELECT * FROM active_appointments";
$show = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($show)){
	echo $row[3];
	echo '</br>';
	echo $row[4];
	echo '</br>';
	echo "Appointment start date".$sss;
	while ($sss < $row[4] && $sss > $row[3]){
		echo "Error";
	}else if ($estim < $row[4] && $estim > $row[3]){
		echo "Error";
	}else{
		$sr = "user1";
	$ss = "service name";
	//$docID = $_REQUEST['docID'];
	$d = strtotime($_POST['date']);
	$today =  date("Y-m-d");
	$t_i_s = strtotime($today);
	$d1 = $d - $t_i_s;
	$s = strtotime ($_POST['time']);
	$properdate = $s + $d1;
	$s1 = date("Y-m-d H:i:s",$properdate);
	$time = 55;
	$timeinsec = $time * 60;
	$service_end_time= $properdate + $timeinsec;
	$est = date("Y-m-d H:i:s", $service_end_time);
	// $appoi_time_insec= strtotime($st); 
	// $time = $_REQUEST['serviceTime'];
	// $timeinsec = $time * 60;
	// $service_end_time= $appoi_time_insec + $timeinsec;
	// $est = date("H:i:s", $service_end_time);
	$insert = mysqli_query($conn, "INSERT INTO active_appointments (requested_By, services_requested,start_time,end_time) 
	                             VALUES ('$sr','$ss','$s1','$est')");
								 
	
	// $query= "SELECT * FROM available_services WHERE id='{$_POST['pn']}'";
	// $result= mysqli_query($conn, $query);
	// if($row = mysqli_fetch_array($result)){
	// echo $row[0];
	// $sname = $row[0];
	// $insert2 = mysqli_query($conn, "INSERT INTO active_appointments (services_requested)
									// SELECT name FROM available_services
									// WHERE id= '$sname'");
	// }								
	if($insert){
		echo '<script>
			alert("Added new appointment!");
			window.location.href="serviceRequested.php";
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
  <label for="staffNo">Service Requested:</label>
     <select class="input-group2" name="serviceName">
		<option> <?php echo $_REQUEST['pn'] ?> </option>	
	
	 </select>
    </div>
	
	<div class="form-label-group" >  
  <label for="staffNo">Estimated Service Time:</label>
     <select class="input-group2" name="serviceTime">
		<option> <?php 
				$query1= "SELECT * FROM available_services WHERE name='{$_REQUEST['pn']}'";
				$result1= mysqli_query($conn, $query1);
				while ($row1 = mysqli_fetch_array($result1)){
					echo $row1[4];
				}
		?> </option>	
	
	 </select>
    </div>
	<div class="form-label-group" >  
  <label for="staffNo">Choose a Date:</label>
     <input type="date" name="date" class="form-control form-control-lg mb-2" id="date" min="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d',strtotime('+7 day'));?>" required  data-error="Please Enter Date.">
    </div>
	<div class="form-label-group" >  
  <label for="staffNo">Choose a Time:</label>
     <input type="time" name="time" class="form-control form-control-lg mb-2" id="datetime" min="09:00:00" max="17:00:00" required  data-error="Please Enter Date.">
    </div>
	
	
	
	
  </select>
     <div class="form-group text-center mb-3">
            <input class="btn btn-secondary btn-block btn-lg" onmousedown="move.play()" name="submit" type="submit">
            </div>
    </ul>
</div></div>
</div>
</div>
</div>
</div>
</body>