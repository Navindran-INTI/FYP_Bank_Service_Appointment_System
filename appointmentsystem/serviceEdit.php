<?php

$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");



if(isset($_POST['update'])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$description = mysqli_real_escape_string($conn, $_POST['description']);
	$requirements = mysqli_real_escape_string($conn, $_POST['requirements']);
	$time = mysqli_real_escape_string($conn, $_POST['time']);
	
	$update = mysqli_query($conn, "UPDATE available_services SET name='$name', description='$description' , requirements='$requirements', time='$time' WHERE id='{$_POST['id']}'");
	if($update){
    echo '<script>
			alert("Successfully updated job!");
			window.location.href="service_list.php";
			</script>';
    echo '<div class="container py-2 mt-2">
    <div class="col-md-6 ml-5 pl-5 ml-auto mx-auto">
    <div class="p-3 mb-2 bg-success text-white">Successfully edit record !</div>
  </div>
  </div>';
    
	} else {
		echo 'Failed to edit record because '.mysqli_error($conn);
	}
}


$query = mysqli_query($conn, "SELECT * FROM available_services WHERE id='{$_REQUEST['pn']}' ");
while($row = mysqli_fetch_array($query)){	
	$jn = $row['name'];
	$js = $row['description'];
	$jp = $row['requirements'];
	$jt = $row['time'];
	$pn = $row['id'];
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
</head>
<body>

<div class="container">
<form class="ml-5" action="<?php echo $_SERVER['PHP_SELF']; ?>?pn=<?php echo $_REQUEST['pn']; ?>" method="post">
<input type="hidden" value="<?php echo $_REQUEST['pn']; ?>" name="id" >
<b><table></b>
  <tr>
   <br><td colspan="2"><input type="button" value="Back" onmousedown="moveback.play()" onclick="window.location = 'service_list.php'" class="mb-2 btn btn-secondary"></td></br>
  </tr>
  <tr>
    <b><td colspan="2"><h3>EDIT Bank Services</h3></td></br><b>
  </tr>
  <tr>
	  <td>Service Name:</td>
    <td><input class="form-control form-control-lg mb-2" type="text" name="name" value="<?php echo $jn; ?>"></td>
  </tr>
	  <tr> 
    <td>Description:</td>
    <td><input class="form-control form-control-lg mb-2" type="text" name="description" value="<?php echo $js; ?>"></td>
  </tr>
  <tr> 
    <td>Requirements:</td>
    <td><?php

//$conn = mysqli_connect("localhost", "root", "");
//$db = mysqli_select_db($conn, "appointment_system");
$query1= "SELECT * FROM available_services WHERE id='{$_REQUEST['pn']}'";
$result1= mysqli_query($conn, $query1);

while ($row = mysqli_fetch_array($result1)){
	?>
	<html>
	<textarea name="requirements" type="multipart/form-data" rows="10" cols="30" value="<?php echo $jp; ?>">
	<?php
	echo"{$row[3]}";
	?>
	</textarea>
	</html>
	<?php
}

?></td>
  </tr>
  <tr> 
    <td>Service Time(min):</td>
    <td><input class="form-control form-control-lg mb-2" type="number" name="time" value="<?php echo $jt; ?>"></td>
  </tr>
  <tr> 
  <tr>
    <td colspan="2"><input type="submit" name="update" value="Update" onmousedown="sub1.play()" class="mt-2 btn btn-secondary"></td>
  </tr>
</table>

</form>
</div>

</body>
</html>