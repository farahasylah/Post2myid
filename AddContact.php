<?php include("sources.php"); ?>
<html>
<head>
	<title>Add Contact</title>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
</head>
<script type = "text/javascript" language = "javascript">	
	$(document).ready(function() {
		$("#validate-form").validate({
			//specify the validation rules
			rules: {
				email: {
					  required: true,
					  number: false,
				}
			},
			submitHandler: function(form){
					form.submit();
			}
		});
	});
</script>
<body>
	<?php
		if(!isset($_SESSION["Member"])) 
		{	header("Location: Login.php"); 	}
		else	
		{	$Member = $_SESSION["Member"];	}
	?>
	<div id="content-shipment"></br>
			<div class="panel panel-default">
			<div class="panel-heading"><h2>Add Contact</h2></div>
			<div class="panel-body">
				<form name = "AddContact" method = "get" action = ""  id = "validate-form">
					<div class="row">
						<div class="col-lg-3 col-md-3 col-xs-12">
							<label>Enter email address &nbsp; : &nbsp;</label>
						</div>
						<div class="col-lg-9 col-md-9 col-xs-12">
							<input type="email" name = "email" id="email" class= "inputbox" placeholder="Enter email" style="position:relative;width:100%;">
						</div>
					</div>
					<p><img src="LoaderIcon.gif" id="loaderIcon" style="display:none" /></p>
					<span class="glyphicon glyphicon-ok-circle" style="display:none"></span>
					<span class="glyphicon glyphicon-remove-circle" style="display:none;" ></span>
					<span class = "retrievebox" id="alert" name="alert" ></span>
					<input type = "submit" name="submit" value ="Submit"  id ="Submit" class = "btn"  />
				</form>
			</div>
		<hr>
			<div class="panel-body" >
			<div  class="well" id = "show" style="display:none;">
				<p id="title" ></p>
				<p><span class="glyphicon glyphicon-user" style="display:none;" ></span>
					<span class="glyphicon glyphicon-send" style="display:none;" ></span>
					<span class = "retrievebox" id="showemail" name="showemail" ></span>
				</p>
				<form method = "post" ><input type = "submit" name="invite" id ="invite" value="Invite" class = "btn" style="display:none;" /></form>
				<form method = "post" ><input type = "submit" name="add" id ="add" value="Add" class = "btn"   style="display:none;" /></form>
				</br>
			</div>
			</div>	
		</div>
	</div>
</body>
</html>
<?php 
if(isset($_GET['submit']) && !empty($_GET['email'])) {
	$email = $_GET['email'];
	$check_contact = "SELECT * FROM `Account` WHERE `Acc_email`='$email'";
	$result = mysqli_query($conn, $check_contact); 
	echo '<script>
				$("#showemail").text(" '.$email .' ")
				$("#show").show();
				</script>';
	if ($row = mysqli_fetch_assoc($result)){
		$rid= $row['acc_ID']; 
		$check_fren = "SELECT * FROM `Contacts` WHERE `R_id`='$rid' AND S_id = '$Member' ";
		$checkf = mysqli_query($conn, $check_fren); 
		if ($rows=mysqli_fetch_assoc($checkf)){
		 	echo '<script>
			$(".glyphicon-user").show();
			document.getElementById("alert").innerHTML = "You have added this person to your contact list";
			</script>';
		 }
		else{
		 		if($row['acc_ID'] == $Member){
					echo '<script>
					$(".glyphicon-user").show();
					document.getElementById("alert").innerHTML = "This is you";
					</script>';
				}
				else{
					echo '<script>
						$(".glyphicon-ok-circle").show();
						$(".glyphicon-user").show();
						document.getElementById("alert").innerHTML = "User found!";
						$("#add").show();
						</script>';
				}
		}
	 }
	  else{
		  echo '<script>
			$(".glyphicon-remove-circle").show();
			$(".glyphicon-send").show();
			document.getElementById("alert").innerHTML = "User not found!";
			document.getElementById("title").innerHTML = "Would you like to invite ?";
			$("#invite").show();
			</script>';
	  }
}
/*  ------------------------- EMAIL REQUEST (requires server mail)
$style='<style>'.
			  'img{ margin: 15px 30px; height : 100px; width :100px; float:center;}'.
			  'button{ background: #06c9b2;border-radius: 3px;box-shadow: 0px 1px 1px #666666;color: #ffffff; font-size: 15px; '.
				'padding: 1px 30px; height: 50px; float:center; text-align:center;font-family:Arial;cursor:pointer;border-style:none;margin-left:20px; }'.
				'span{ font-family:Arial;font-size:40px;color: #ffffff;float:center;}'.
				'.join{ margin: auto; width: 60%;border: 2px solid #008080;padding-bottom:10px;}'.			
				'.content{text-align:center;}'.
				'.container{ padding:10px;box-sizing: border-box;background-color: #008080;overflow:auto;margin: auto; width: 100%; } </style>';
if(isset($_POST['invite'])){
include("email.php");
	$accemail = $_GET['email'];
			  $to = $accemail;
			  $subject  =   "Invitation to Join";
			  $message  =  '<html>'.
			  '<style>'.
			  'img{ margin: 15px 30px; height : 100px; width :100px; float:center;}'.
			  'button{ background: #06c9b2;border-radius: 3px;box-shadow: 0px 1px 1px #666666;color: #ffffff; font-size: 15px; '.
				'padding: 1px 30px; height: 50px; float:center; text-align:center;font-family:Arial;cursor:pointer;border-style:none;margin-left:20px; }'.
				'span{ font-family:Arial;font-size:40px;color: #ffffff;float:center;}'.
				'.join{ margin: auto; width: 60%;border: 2px solid #008080;padding-bottom:10px;}'.			
				'.content{text-align:center;}'.
				'.container{ padding:10px;box-sizing: border-box;background-color: #008080;overflow:auto;margin: auto; width: 100%; } </style>'.
				'<div class="join"><div class="container"><img src="http://post2myid.tk/postage_stamp.png" name="logo"><span>Post2myID</span></div>'.
				'</br><div class = "content" >Your friend would like you to join. Click the link to get started </br>  <a href="http://post2myid.tk/Register.php"> Join now! </a> '.
				'</div></div></html>';
			  
			  $mailsend =   sendmail($to,$subject,$message,$name);
			  if($mailsend==1){
			   echo '<script>
			   $("#invite").hide();
				$("#show").hide();
				$(".glyphicon-remove-circle").hide();
				document.getElementById("title").innerHTML = "Invitation mail is sent to your friend email";
				</script>';
				}
			  else{
			 echo '<script>
				document.getElementById("title").innerHTML = "Error to send!";
				</script>';
			  }
			  unset($_GET['email']);
	} */
	
if(isset($_POST['add'])){
include("email.php");
	$accemail = $_GET['email'];
	 $add = "INSERT INTO contacts (S_id,R_id)VALUES ($Member,$rid)";
	 $addfren = mysqli_query($conn, $add); 
	 echo "<script>window.location.href='Contacts.php'</script>";
		/* 	echo $actual_link = 'http://post2myid.tk/friendreq.php?rid=' .$rid. '&sid=' .$Member;
			  $to = $accemail;
			  $subject  =   "Friend Request";
			  $message  =  '<html>'.
			  '<style>'.
			  'img{ margin: 15px 30px; height : 100px; width :100px; float:center;}'.
			  'button{ background: #06c9b2;border-radius: 3px;box-shadow: 0px 1px 1px #666666;color: #ffffff; font-size: 15px; '.
				'padding: 1px 30px; height: 50px; float:center; text-align:center;font-family:Arial;cursor:pointer;border-style:none;margin-left:20px; }'.
				'span{ font-family:Arial;font-size:40px;color: #ffffff;float:center;}'.
				'.join{ margin: auto; width: 60%;border: 2px solid #008080;padding-bottom:10px;}'.			
				'.content{text-align:center;}'.
				'.container{ padding:10px;box-sizing: border-box;background-color: #008080;overflow:auto;margin: auto; width: 100%; } </style>'.
				'<div class="join"><div class="container"><span>Post2myID</span></div>'.
				'</br><div class = "content" >Your friend would like to add you.Click the link to approve </br> <a href=" ' .$actual_link. ' "> Approve </a> '.
				'</div></div></html>';
			  
			  //$message  =  "Your friend added you. Click the link to get started <a href='" . $actual_link . "'>" . $actual_link . "</a>";
			  $mailsend =   sendmail($to,$subject,$message,$name);
			  if($mailsend==1){
			   echo '<script>
			   	$(".glyphicon-ok-circle").hide();
			   $("#add").hide();
				$("#show").hide();
				document.getElementById("title").innerHTML = " Contact request sent!";
				</script>'; */
				
				/* }
			  else{
			 echo '<script>
				document.getElementById("title").innerHTML = " Error to send! ";
				</script>';
			  } */
	}
	?>