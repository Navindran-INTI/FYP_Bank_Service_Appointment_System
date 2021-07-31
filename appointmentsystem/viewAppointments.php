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
function viewAppointments(){
	window.location.assign("viewAppointments.php")
}
function viewUserHome(){
	window.location.assign("userhomepage.php")
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
	<h2>User Homepage</h2>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
	 <p>Hi, <?php echo $_SESSION['username']." ".$msg ;?></p>
	  <a href="logout.php" onmousedown="bleep.play()">LOGOUT</a>
	  <a href="#about" onclick="viewUserHome()"  class="w3-bar-item w3-button">MyInfo</a>
      <a onclick="viewUserHome()"  onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-th"></i>SERVICES OFFERED</a>
      <a  onclick="viewAppointments()" onmousedown="bleep.play()" class="w3-bar-item w3-button"><i class="fa fa-usd"></i>VIEW APPOINTMENTS</a>
    </div>
	</div>
<body>

<?php

	
		$conn =mysqli_connect("localhost","root","");
		$db = mysqli_select_db($conn, "appointment_system");
		$name = $_SESSION['username'];
		$query= "SELECT * FROM active_appointments,available_services where requested_By ='$name' AND services_requested=name ";
		$result= mysqli_query($conn, $query);

		
		echo '<div class="container" text-align="center" style="background-color:#A43144"> 
<div class="row">
<div class="col">
    <div class="card">
    <div class="card-header">
<table border="3" class="jobtable">
<thead class="thead-dark">
<tr style="background-color:#A43144">
<th>Appointment ID</th>
<th>START TIME</th>
<th>END TIME</th>
<th>Requested By</th>
<th>Service Requested</th>
<th>Requirements</th>
<th>Action</th>
</tr></div></div></div></div></div>';
while($row = mysqli_fetch_array($result)){
    echo '<div class="container mb-3"> 
    <div class="row" >
    <div class="col">
    <div class="card">

    <thead class="thead-dark"><tr border="5" style="background-color:#ADD8E6">';
	
        echo '<td border="2">'.$row['appoi_ID'].'</td>' ;
		echo '<td >'.$row[3].'</td>' ;
		echo '<td >'.$row[4].'</td>' ;
		echo '<td >'.$row[1].'</td>' ;
		echo '<td >'.$row[2].'</td>' ;
		echo "<td>";
	?>
	<html>
	<textarea type="multipart/form-data" rows="10" cols="30" disabled>
	<?php
	echo "$row[requirements]";
	?>
	</textarea>
	</html>
	<?php
	echo"</td>"."<br>";
	echo "<td>";
?>

<body>


<a href="postpone.php?pn=<?php echo $row['appoi_ID'];?>">
<button type="button" onmousedown="move.play()" class="btn btn-success">
Postpone
</button> 
</a>
<a href="cancel.php?pn=<?php echo $row[0]; ?>">
<button type="button" onmousedown="boop.play()" class="btn btn-danger">
Cancel
</button>
</a>
<?php
        echo '</td></tr>
        </div></div></div></div>';
		
		
}
echo '</table>';

	?>
		
	</table>

</body>

<footer class="w3-center w3-black w3-padding-64">
  <a href="#home" onmousedown="del.play()" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  <div class="w3-xlarge w3-section">
    
  </div>
  <p>Powered by Group</p>
</footer>
</html>