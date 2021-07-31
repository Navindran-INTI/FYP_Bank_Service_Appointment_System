<?php

   
   $conn =mysqli_connect("localhost","root","");
		$db = mysqli_select_db($conn, "appointment_system");
		
		
		$result = mysqli_query($conn, "SELECT servicelog.service_time, available_services.time 
										FROM servicelog, available_services
										WHERE servicelog.name=available_services.name");
		while($row = mysqli_fetch_array($result)){
			if($row['service_time'] < $row['time'] ){
					
					$updatedtime = mysqli_real_escape_string($conn, $row['service_time']);
					$update = mysqli_query($conn, "UPDATE available_services SET time='$updatedtime' WHERE name=servicelog.name");
					
					if($update){
					echo '<script>
							alert("Successfully updated service!");
							window.location.href="service_list.php";
					</script>';}
			}
			echo $row['service_time'];
			echo "</br>";
			echo $row['time']."</br>";
			
		}
		
		
?>
<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	 <div class="container center_div mb-3">
    <div class="row rwdown">
      <div class="col-sm-15 col-md-7 col-lg-18 mx-auto">
        <div class="card card-signin my-0">
          <div class="card-body">
              <h5 class="card-title text-center"></h5>	
     <input type="hidden" value="<?php echo $_REQUEST['pn']; ?>" name="id" >
</form>