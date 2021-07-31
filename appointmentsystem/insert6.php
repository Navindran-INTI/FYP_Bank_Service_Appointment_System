<?php 
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");


if(isset($_POST['submit'])){
	
	$start = strtotime($_POST['time1']);
	$end = strtotime($_POST['time2']);
	$real_start = date("Y-m-d H:i:s", $start);
	$real_end = date("Y-m-d H:i:s", $end);
	echo $real_start; 
	
	$overlap = "SELECT * FROM time WHERE (end_time >'$real_start'  AND  begin_time < '$real_start') 
				OR
				(end_time >'$real_end'  AND  begin_time < '$real_end')"; 
							
	$overlapres = mysqli_query($conn, $overlap);
	$count=mysqli_num_rows($overlapres);
		echo "Count:".$count;
		echo '</br></br>';
		if($count != 0){
		echo "Time clashing!";
		}else{
		$query = "INSERT INTO time (begin_time,end_time) VALUES ('$real_start','$real_end')";
		$result = mysqli_query($conn, $query);
			if($result){
			echo "Insert succcessfull";
			}
	    }
	
	
	// if ($end < $start){
	 // echo "Start should be earlier";
	// } else {
	 
	 
	 // if($result){
		// echo "Insert succcessfull";
	 // }
	 
	 

}
?>



<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
<div class="form-label-group" >  
  
	<div class="form-label-group">
    <label for="fName :">Customer Entry Time:</label>
     <input type="time" name="time1"  id="time1"  required="required" data-error="Please enter Time">
    </div>
	<div class="form-label-group">
    <label for="fName :">Customer Exit Time:</label>
     <input type="time" name="time2"  id="time2" required="required" data-error="Please enter Time">
    </div>

            <input class="btn btn-success" onmousedown="move.play()" value="Submit" name="submit" type="submit">
            </div> </form>