<head>	
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
</script>
<script>
var check = function() {
  if (document.getElementById('pwd').value ==
    document.getElementById('password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'matching';
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'not matching';
  }
}
</script>
</head>

<body>
<div class="container">
	<div class="login-box">
	<div class="row">
<div class="col-md-6 login-right">
		<h2>Register Here</h2>
		<form action="verify_registration.php" method="post">
			<div class="form-group">
			<label>Username</label>
			<input type="text" name="user" class="form-control" required>
			</div>
			<div class="form-group">
			<label>Password</label>
			<input type="password" name="pwd" id="pwd" class="form-control" onkeyup='check();' required>
			</div>
			<div class="form-group">
			<label>Confirm Password</label>
			<input type="password" name="password" id="password" class="form-control" onkeyup='check();' required>
			<span id='message'></span>
			</div>
			<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" required>
			</div>
			<div>
			<!-- <label>Select User Type:</label>
					<select name="usertype" required>
						<option value="admin">Admin</option>
						<option value="user">User</option>
					</select>
			</div> -->
			<button type="submit" onmousedown="sub1.play()" class="btn btn-primary">Register</button>
		</form>
	</div>
	</div>
	</div>
	</div>
	
</body>
	