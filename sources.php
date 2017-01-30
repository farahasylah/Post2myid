<?php include("connect.php"); ?>
<head>
	<link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Muli" />
	<script type = "text/javascript" language = "javascript">
	  function display_c(){
		var refresh=1000; // Refresh rate in milli seconds
		mytime=setTimeout('display_ct()',refresh)
	}

	function display_ct() {
		var strcount
		var x = new Date()
		document.getElementById('ct').innerHTML = x;
		tt=display_c();
	}
</script>
	
</head>
<body>

	<div id="container">
		<img src="postage_stamp.png" name = "logo" alt="mail" >
		</br>
		<span class = "header">Post2myID</span>
		<span class="timestamp" id='ct' ></span>
		<body onload=display_ct();>
		<?php if(isset($_SESSION["Member"])) {
		?>
		<a class="warn" href="Logout.php"><span class="glyphicon glyphicon-log-out" ></span> Log Out</a>
<?php } ?>
		
	</div>
	
	<div id="menu" class="navbar navbar-default " role="navigation">
		<div class="container-fluid">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
			   <li  class ="homeNav"><a id ="homeNav" href="home.php" >Home</a></li>
			   <li  class ="trackNav"><a id ="trackNav" href="TrackShipment.php">Track Shipment</a></li>
				<?php
					if(isset($_SESSION["Member"])) { ?>
					<li class ="shipNav"><a id ="shipNav" href="Shipment.php" >Make Shipment</a></li>	
					<li class ="accNav"><a id ="accNav" href="Account.php">Account</a></li>	
					<li class ="cNav"><a id ="cNav" href="Contacts.php">My Contacs</a></li>		
				<?php	}?>
			</ul>
			<?php
			if(!isset($_SESSION["Member"])) { ?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="glyphicon glyphicon-user"> </span>   Login
				  </a>
				  <ul class="dropdown-menu">
				  	<div class="panel panel-default">
					<div class="panel-body">
					  <form role="form" action="" method="get">
						<div class="form-group">
						  <label for="email">Email:</label>
						  <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
						</div>
						<div class="form-group">
						  <label for="pwd">Password:</label>
						  <input type="password" name="password" class="form-control" id="pwd" placeholder="Enter password" required>
						</div>
						<input type = "submit" value ="Login" name="submit" class = "btn"/>
					  </form>
						</div>
						</div>
					
					<li><a href="Register.php">New here? Join now!</a></li>
					
				  </ul>
				</li>
			</ul>
			<?php	}?>
        </div>
		</div>
   
</body>
</html>
	
	
<?php
if(!isset($_SESSION["Member"])) {
if (isset($_GET['submit'])){
	$email= $_GET['email'];
	$password = $_GET['password'];
	$check_admin = "SELECT * FROM `Account` WHERE Acc_email='$email' 
									and password='".$_GET['password']."'";
	
	$result = mysqli_query($conn, $check_admin); 
    while ($row = mysqli_fetch_assoc($result)){
       	$_SESSION["Member"] = $row["acc_ID"]; 	
       	echo'<script type="text/javascript">alert("Login Successful!");
				</script>';
		echo "<script>window.location.href='home.php'</script>";
	}
	echo "<div class='form'>
	<h3>Username/password is incorrect.</h3>
	<br/>Click here to <a href='login.php'>Login</a></div>";
}
}
?>