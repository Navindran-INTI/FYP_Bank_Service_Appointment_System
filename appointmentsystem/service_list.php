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
$con = mysqli_connect("localhost", "root", "");
$db =mysqli_select_db($con, "appointment_system");
//echo '<input type="button" class="btn btn-outline-secondary btn-block btn-lg mb-3" onmousedown="del.play()" value="Go to Homepage" onclick="viewHomepage()">';
$query= "SELECT * FROM available_services";
$result= mysqli_query($con, $query);


echo '<form action="'.$_SERVER['PHP_SELF'].'" method="post"><table border="1">
		<tr>
		</br>
		
		
		<td><input type="text" name="searchquery" required></td>
		<td><input type="submit" class="btn btn-info" onmousedown="sub2.play()" name="search" value="Search"></td>
		</tr>
		</table>
		</form>';
		?>
		<a href="serviceAdd.php">
		<button type="button" onmousedown="sub1.play()" class="btn btn-success">
		Add
		</button> 
		</a>
		<?php
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
	echo"<td>{$row[4]}</td>"."<br>";
	echo "<td>";
?>

<body>


<a href="serviceEdit.php?pn=<?php echo $row[0];?>">
<button type="button" onmousedown="move.play()" class="btn btn-success">
Edit
</button> 
</a>
<a href="serviceDelete.php?pn=<?php echo $row[0]; ?>">
<button type="button" onmousedown="boop.play()" class="btn btn-danger">
Delete
</button>
</a>
<?php
echo "</td></tr>";
}
if(isset($_POST['search'])){
	$search = mysqli_real_escape_string($con, $_POST['searchquery']);
	$query = mysqli_query($con, "SELECT * FROM available_services WHERE name LIKE '%$search%' ");
	
	if(mysqli_num_rows($query)!=0){
		echo '<table border="1">
		<tr>
		<td>Service Name</td>
		<td>Drscription</td>
		<td>Requirement</td>
		<td>Service Time(minutes)</td>
		<td>Action</td>
		</tr>';
		while($row = mysqli_fetch_array($query)){
			echo '<tr>
				<td>'.$row['name'].'</td>
				<td>'.$row['description'].'</td>
				<td>'.$row['requirements'].'</td>
				<td>'.$row['time'].'</td>
				<td><input type="button" class="btn btn-success" onmousedown="move.play()" onclick="window.location = \'serviceEdit.php?pn='.$row['id'].'\'" value="Edit">
				<input type="button" class="btn btn-danger" onmousedown="boop.play()" onclick="window.location = \'serviceDelete.php?pn='.$row['id'].'\'" value="Delete"></td>
				</tr>';
		}
		echo '</table>';
		exit();
	} else {
		echo '<h2>No result</h2>';
		exit();
	}
}
?>

</body>
</html>