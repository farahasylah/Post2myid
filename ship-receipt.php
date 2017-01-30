<?php include("sources.php"); ?>
<html>
<head>
	<title>Shipment Receipt</title>
	<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
</head>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}
</script>
	<body>
	<?php
		if(!isset($_SESSION["Member"]))
		{
			header("Location: Login.php"); 
		}
		else
		{
			$Member = $_SESSION["Member"];
			
		}
		
	?>
	<?php 
	$id = unserialize($_GET['orderid']);
	
	$names = array("Recipient email :  ", "Order ID :  ", "Order Date :  ", "Type :  ", "Weight :  ");
	$qrid = serialize($id);
	//$id = $_GET["a"];
	//print_r($id);
	//echo $id[0].'==';	newIframe.src = " http://post2myid.tk/qrcode.php?orderid='.$id[$x].' '"; 
//	echo $id[1].'<<';
	for ($x = 0; $x < sizeof($id); $x++) {
	$sql = "SELECT Account.Acc_email, Shipment.OrderID,Shipment.OrderDate,Shipment.p_type,Shipment.p_weight
						FROM Shipment INNER JOIN Account
						ON  Shipment.R_id = Account.acc_ID WHERE Shipment.OrderID='$id[$x]';";
	$acc = mysql_query($sql);
	while ($ac = mysql_fetch_array($acc))
    {
	echo '<script language = "Javascript">
		$(document).ready(function() {
			var col = document.getElementById("col");
			var cols = document.createElement("div");
			cols.className = "col-lg-4 col-md-6 col-xs-6";
			col.appendChild(cols);
			
			var iDiv = document.createElement("div");
			iDiv.id = "well";
			iDiv.className = "well";
			cols.appendChild(iDiv);

			var p = document.createElement("span");
			p.innerHTML = " '.$names[0].$ac[0].' </br> '.$names[1].$ac[1].'  </br> '.$names[2].$ac[2].'  </br> '.$names[3].$ac[3].'  </br> '.$names[4].$ac[4].' ";
			iDiv.appendChild(p);
			
			var col2 = document.getElementById("col2");
			var newIframe = document.createElement("iframe");
			newIframe.id = "aaa";
			newIframe.width = "300";
			newIframe.height = "390";
			newIframe.src = " http://post2myid.tk/qrcode.php?orderid='.$id[$x].' "; 
			iDiv.appendChild(newIframe);
				});
			</script>';
			

	}
	}
	/*
	var qr = document.getElementById("aa");
			var newIframe = document.createElement("iframe");
			newIframe.width = "300";
			newIframe.height = "390";
			newIframe.src = " http://post2myid.tk/qrcode.php?orderid='.$id[$x].' "; 
			qr.appendChild(newIframe);
	
	*/
	//$(".well:last").clone().insertAfter(".well:last");
$link = 'http://post2myid.tk/pdf.php?orderid='.$qrid;
?>
<div id="container">
		<img src="postage_stamp.png" name = "logo" alt="mail" >
		</br>
		<span class = "header">Post2myID</span>
		<span class="timestamp" id='ct' ></span>
		<body onload=display_ct();>
		<a class="warn" href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a>
	</div>

	<div id="menu" class="navbar navbar-default " role="navigation">
		<div class="container-fluid">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse navbar-menubuilder">
            <ul class="nav navbar-nav navbar-left">
                <li><a href="MemberHome.php" >Home</a></li>
				<li><a href="Shipment.php" >Make Shipment</a></li>	
				<li><a href="MemberTrack.php">Track Shipment</a></li>
				<li><a href="Account.php">Account</a></li>	
				<li><a href="Contacts.php">My Contacs</a></li>		
			</ul>
        </div>
    </div>
		
		
	
	<div id="content-shipment">
	<h2>Shipment Receipt</h2>
	
		 <div class="row" id ="aa" >
		  <button type="button" onClick="location.href ='<?php echo $link ?>' " class = "btn" > PDF <span class="glyphicon glyphicon-download" ></span></button>
		 <div class="col-lg-12"  id = "col">
		
		 </div>
		 </div>
		<!--
		<iframe src="<?php echo $link ?>" style = "border:none; width:100%; height:100%;" ></iframe>
		<div id="product">
			<div class="product-item float-clear" style="clear:both;">
				<div class="float-left"><iframe src='http://post2myid.tk'></iframe></div>
			</div>
		</div>
		
	-->
		
	</div>
		
	<div id="footer">
		<span>Copyright &copy; 2015. All Rights Reserved </span>
		<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
	</div>
	</body>
</html>

