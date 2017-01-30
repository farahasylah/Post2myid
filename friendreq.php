<?php include("connect.php");

		
		else{
			die( mysql_error());
			}
			
	if(!empty($_GET["rid"])) {
	$rid = $_GET["rid"];
	$sid = $_GET["sid"];
	echo $cid;
			echo $rid;
			echo $sid;
	$sql = mysql_query("INSERT INTO Contacts (R_id,S_id) VALUES ('$rid', '$sid');"); 
		if (!$sql) {
			$message = "Problem in adding contact";
		} else {
			$message = "Contact added";
		}
	}
?>
<html>
<head>
<title>POST2MYID Friend Request</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php if(isset($message)) { ?>
<div class="message"><?php echo $message; ?></div>
<?php } ?>
</body></html>