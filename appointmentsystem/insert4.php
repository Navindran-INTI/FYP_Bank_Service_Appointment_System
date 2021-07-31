<?php
if(isset($_POST['submit'])){
	$start = $_POST['time1'];
	$end = $_POST['time2'];
	if ($end < $start){
	 echo "Start should be earlier";
	} else {
	 echo "Start is earlier";
	}
	
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