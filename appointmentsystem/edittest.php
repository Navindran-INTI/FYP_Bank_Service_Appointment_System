<?php

//$conn = mysqli_connect("localhost", "root", "");
//$db = mysqli_select_db($conn, "appointment_system");
$query1= "SELECT * FROM bank_services WHERE name='asdasd'";
$result1= mysqli_query($conn, $query1);

while ($row = mysqli_fetch_array($result1)){
	?>
	<html>
	<textarea type="multipart/form-data" rows="10" cols="30" >
	<?php
	echo"{$row[3]}";
	?>
	</textarea>
	</html>
	<?php
}

?>