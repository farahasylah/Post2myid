<?php include("sources.php"); ?>
<html>
<head><title>Registration</title>
	 <link rel="stylesheet" type="text/css" href="styles.css" />
    <style type="text/css" media="screen"></style>
	<style>
#frmCheckUsername {border-top:#F0F0F0 2px solid;background:#FAF8F8;padding:10px;}
.demoInputBox{padding:7px; border:#F0F0F0 1px solid; border-radius:4px;}
.status-available{color:#2FC332;}
.status-not-available{color:#D60202;}
</style>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
	  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMhmkThgiu1mNBP6PuuN4NZbIsBQLBWjg&libraries=places&callback=initAutocomplete"
        async defer></script>

</head>
 <script type = "text/javascript" language = "javascript">
	function checkPass()
	{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
	}
 $(document).ready(function() {
  $( ".editable" ).css("border", "1px solid #d1c7ac");
	$( ".editable" ).css("background-color", "cornsilk");
	$("#geocomplete").geocomplete({
									  map: ".map_canvas",
									  details: "form",
									  types: ["geocode", "establishment"],
									});
			$("#geocomplete").trigger("geocode");

	$("#validate-form").validate({
		//specify the validation rules
		rules: {
		firstname: "required",
		tel: "required",
		postal_code: {
		  required: true,
		  number: true,
		}
		},
		 submitHandler: function(form){
			form.submit();	}
	});	});
</script>

<body>
	<div id="content-shipment" >
	<div class="row" style="margin:0px !important">
	<form class="form-horizontal" role="form" name = "Registration" method = "post" class = "Reg"  id = "validate-form">
		<h2> Registration Form </h2></br>
		<div id="mail-status"></div>
		<span id="alert"></span>
		<div class="col-lg-6 col-md-6 col-xs-12" >
			<p>
			<label> First Name &nbsp; : </label>
			<input type = "text" name = "firstname" class = "inputbox" />
			</p>		
		</div>		
		<div class="col-lg-6 col-md-6 col-xs-12" >
			<p>
			<label> Last Name  &nbsp; : </label>
			<input type = "text" name = "lastname"  class = "inputbox" /></p>
		</div>		
		<div class="col-lg-6 col-md-6 col-xs-12" >
				<p><label> Email address &nbsp; : </label>
				<input type = "email" name="email" id="email"  class = "inputbox" placeholder="web@mail.com" required = "true"/></p>
				<p><label>Phone No &nbsp; : </label>
				<input type = "tel" name = "tel" placeholder = "012-3456789" class = "inputbox" pattern = "\d{3}-\d{7}" /></p>
		</div>	
		<div class="col-lg-12 col-md-12 col-xs-12" ><hr>
			<label ><u>  Address  </u></label></br></div>
		<div class="col-lg-6 col-md-6 col-xs-12" >
			<fieldset>
			<p><label> Name &nbsp; : </label>
				<input name="name" class = "inputbox" type="text" value=""></p>
			<p><label> Street &nbsp; : </label>
				<input name="street_number" class = "inputbox" type="text" value=""></p>
			<p><label>  </label>
				<input name="route" class = "inputbox" type="text" value=""></p></br>
			<p><label>  </label>
				<input name="sublocality" class = "inputbox" type="text" value=""></p></br>
			<p><label> Postal Code &nbsp; : </label>
				<input name="postal_code" class = "inputbox" type="text" value=""></p>
			<p><label> City &nbsp; : </label>
				<input name="locality" class = "inputbox" type="text" value=""></p>
			<p><label>State &nbsp; : </label>
				<input name="administrative_area_level_1" class = "inputbox" type="text" value=""></p>
			<p>	<label>Country &nbsp; : </label>
				<input name="country" class = "inputbox" type="text" value=""></p>	
			</fieldset>
		</div>
		<div class="col-lg-6 col-md-6 col-xs-12" >
			<p><input class = "inputbox" id="geocomplete"name="geocomplete" type="text" placeholder="Search" value=""/></p>
			</br><p>
				<div class="map_canvas"></div ></p>	
		</div>
		<div class="col-lg-12 col-md-12 col-xs-12" ><hr>
			<p><label> Password &nbsp; : </label>
				<input type = "password" name = "password" id = "pass1" class = "inputbox" required="true"/></p>
			<p><label> Re-type password &nbsp; : </label>
				<input type = "password" name = "repassword" id = "pass2" onkeyup="checkPass(); return false;" class = "inputbox" required="true"/></p>
			<span id="confirmMessage" class="confirmMessage"></span>
			</br>
			<input type = "submit" name="submit" value ="Submit" class = "btn" />
			<input type = "reset" name="clear" value ="Clear" class = "btn" />
		</div>
	</form>
	</div>
</div>
	<div id="footer">
			<span>Copyright &copy; 2015. All Rights Reserved </span>
			<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
	</div>
</body>
	
</html>

<?php 
if(isset($_POST['submit'])){
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$email = stripslashes($_POST['email']);
	$email = mysqli_real_escape_string($conn,$email);
	$tel = $_POST["tel"];
	$street_address = $_POST["name"].' '.$_POST["street_number"].' '.$_POST["route"].' '.$_POST["sublocality"];
	$postcode = $_POST["postal_code"];
	$city = $_POST["locality"].' '.$_POST["administrative_area_level_1"];
	$country = $_POST["country"];
	$password = stripslashes($_POST['password']);
	$password = mysqli_real_escape_string($conn,$password);
	
	$insert_sql = "INSERT INTO statuses (title, content, author_id, author_name) VALUES (?, ?, ?, ?)";

	$stmt = mysqli_stmt_init($conn);
    $insert_sql = "INSERT INTO Account ( acc_ID,Acc_email, password, firstname, lastname, phone_no, street_address, postcode, 
							country, city,verified)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	$verify = "1";
 
    if (mysqli_stmt_prepare($stmt, $insert_sql))
    {
      mysqli_stmt_bind_param($stmt, "X02134",$email, $password, $_POST["firstname"],$_POST["lastname"], 
	  $_POST["tel"], $street_address, $_POST["postal_code"], $_POST["country"],$city,$verify);
      mysqli_execute($stmt);
	     echo "<div class='form'>
			<h3>You are registered successfully.</h3>
			<br/>Click here to <a href='login.php'>Login</a></div>";
	  //echo '<script type="text/javascript">alert("Registration Success!");
		//		</script>';
			$accid = $row["acc_ID"]; 
			$_SESSION["Member"] = $accid;
    }
/* 
$insert_sql = "INSERT INTO Account ( acc_ID,Acc_email, password, firstname, lastname, phone_no, street_address, postcode, 
							country, city,verified)VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
 
    if (mysqli_stmt_prepare($stmt, $insert_sql))
    {
      mysqli_stmt_bind_param($stmt, "X02134", $_POST["email"], $_POST["password"], $_POST["firstname"],$_POST["lastname"], 
	  $_POST["tel"], $street_address, $_POST["postal_code"], $_POST["country"],$city,"1");
      mysqli_execute($stmt);
	  echo '<script type="text/javascript">alert("Registration Success!");
				</script>';
			$accid = $row["acc_ID"]; 
			$_SESSION["Member"] = $accid;
    } */
//	$sql = mysql_query("INSERT INTO `Account` ( `Acc_email`, `password`, `firstname`, `lastname`, `phone_no`, `street_address`, `postcode`, `country`, `city`)
//			  VALUES ('$email', '$password', '$firstname', '$lastname', '$phone_no', '$street_address', '$postcode', '$country', '$city');"); 	  
	//if (!$sql){
//		die("Failed" . mysql_error());
//	}
	/*else{
	echo '<script type="text/javascript">alert("Registration Success!");
				</script>';
			$accid = $row["acc_ID"]; 
			$_SESSION["Member"] = $accid;
			
			include("email.php");
			 //$actual_link = "http://post2myid.tk/activate.php?id=" . $accid;
			  $to = $email;
			  $subject  =   "Account Registration Email";
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
				'</br><div class = "content" >Thank for your registration. You may login to the system </br> <a href="http://post2myid.tk/home.php"> Log in </a> '.
				'</div></div></html>';
		//	  $message  =  "Click this link to activate your account. <a href='" . $actual_link . "'>" . $actual_link . "</a>";
			  $mailsend =   sendmail($to,$subject,$message,$name);
			  if($mailsend==1){
				echo '<script>
				document.getElementById("alert").innerHTML = "You have successfully registered. You may login to the system";
				</script>';
				echo "<script>window.location.href='home.php'</script>";
				}
			  else{
				echo '<script>
				document.getElementById("alert").innerHTML = "Error to send ";
				</script>';
			  }


	}*/
}
?>