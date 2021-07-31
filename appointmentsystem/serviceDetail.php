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
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="style2.css">

<body>
	<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button w3-wide"><img src="img/logo.png" style="width:10em; "/></a>
	<h1>Bank Service Appointment System</h1>
	<h2>User Homepage</h2>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	 <p>Hi, <?php echo $_SESSION['username']." ".$msg ;?></p>
	  <a href="logout.php" onmousedown="bleep.play()">LOGOUT</a>
      <a href="#about" onclick="viewUserHome()"  class="w3-bar-item w3-button">MyInfo</a>
      <a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-th"></i>SERVICES OFFERED</a>
      <a  onclick="viewAppointments()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-usd"></i>VIEW APPOINTMENTS</a>
      
    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

</head>
<div class="w3-center jobdiv" style="padding:128px 16px">
<?php
$con = mysqli_connect("localhost", "root", "");
$db =mysqli_select_db($con, "appointment_system");


$query= "SELECT * FROM available_services WHERE name='{$_REQUEST['pn']}'";
$result= mysqli_query($con, $query);

echo "<table width= '50%' border='1'>";
echo "<tr><th>Service Name</th><th>Description</th><th>Requirements</th><th>Service Time(min)</th><th>Action</th></tr>";
while ($row = mysqli_fetch_array($result)){
	echo "<tr><td>{$row[1]}</td>"."<br>";
    echo "<td>{$row[2]}</td>"."<br>";
	echo "<td>";
	?>
	<html>
	<textarea type="multipart/form-data" rows="10" cols="30" disabled>
	<?php
	echo"{$row[3]}";
	?>
	</textarea>
	</html>
	<?php
	echo"</td>"."<br>";
	echo "<td>{$row[4]}</td>"."<br>";
		echo "<td>";
?>

<body>


<a href="serviceRequested.php?pn=<?php echo $row[1];?>">
<button type="button" onmousedown="move.play()" class="btn btn-success">
Request Service
</button> 
</a>

<?php
echo "</td>";
	
	echo "</tr>";
}
?>
</div>