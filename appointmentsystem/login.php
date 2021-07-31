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
</head>
<body>
<div class="container">
	<div class="login-box">
	<div class="row">
	<div class="col-md-6 login-left">
		<h2>Login Here</h2>
		<form action="verify_login.php" method="post">
			<div class="form-group">
			<label>Username</label>
			<input type="text" name="user" class="form-control" required>
			</div>
			<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" class="form-control" required>
			</div>
			<button type="submit" onmousedown="bleep.play()" class="btn btn-primary">Login</button>
		</form>
	</div>
	</div>
	</div>
</div>
</body>