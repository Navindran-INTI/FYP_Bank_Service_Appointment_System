<?php
$conn = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($conn, "appointment_system");
?>
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
<script>
function viewServices(){
	window.location.assign("service_list.php")
}
</script>
</head>
<?php

if(isset($_POST['submit'])){{
	
	
	$sn = mysqli_real_escape_string($conn, $_POST['name']);
	$sd = mysqli_real_escape_string($conn, $_POST['description']);
	$sr = mysqli_real_escape_string($conn, $_POST['requirements']);
	$st = mysqli_real_escape_string($conn, $_POST['time']);
	//Register New Property to propertyforrent able
	$insert = mysqli_query($conn, "INSERT INTO available_services (name, description, requirements, time) 
	                             VALUES ('$sn', '$sd', '$sr', '$st')");
	if($insert){
		echo '<script>
			alert("Added new service!");
			window.location.href="serviceAdd.php";
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

?>

<body>

<section class=" py-3 mt-3 ">

</section>
	<form name="contentForm" enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" role="form">
	 <div class="container center_div mb-3">
    <div class="row rwdown">
      <div class="col-sm-15 col-md-7 col-lg-18 mx-auto">
        <div class="card card-signin my-0">
          <div class="card-body">
              <h5 class="card-title text-center"></h5>	
              <input type="button" class="btn btn-outline-secondary btn-block btn-lg mb-3" onmousedown="moveback.play()" value="Go Back" onclick="viewServices()">  
	<div class="form-label-group" >  
  <label for="staffNo">Service Name:</label>
     <input type="text" name="name" class="form-control form-control-lg mb-2" id="name" placeholder="Enter Service Name" required="required" data-error="Please Enter New Service Name.">
    </div>
			  
	<div class="form-label-group">
    <label for="fName :">Description:</label>
     <input type="text" name="description" class="form-control form-control-lg mb-2" id="description" placeholder="Enter Description" required="required" data-error="Please enter new Description">
    </div>
	
	<div class="form-label-group">
    <label for="fName :">Requirements:</label>
     <textarea type="multipart/form-data" name="requirements" rows="10" cols="30" class="form-control form-control-lg mb-2" id="requirements" placeholder="Enter Requirements" required="required" data-error="Please enter new Requirements">
		</textarea>
	</div>
	
	<div class="form-label-group">
    <label for="fName :">Service Time(min):</label>
     <input type="number" name="time" class="form-control form-control-lg mb-2" id="time" placeholder="Enter time in minutes" required="required" data-error="Please enter new time">
    </div>
  </select>
     <div class="form-group text-center mb-3">
            <input class="btn btn-secondary btn-block btn-lg" onmousedown="move.play()" value="Submit" name="submit" type="submit">
            </div>
    </ul>
</div></div>

</body>