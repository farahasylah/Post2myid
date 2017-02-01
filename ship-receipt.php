<?php include("sources.php"); ?>
<html>
<head>
	<title>Shipment Receipt</title>
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
	
	<?php
		if(!isset($_SESSION["Member"]))
		{	header("Location: Login.php"); }
		else
		{	$Member = $_SESSION["Member"];	}

	$id = unserialize($_GET['orderid']);
	$names = array("Recipient email :  ", "Order ID :  ", "Order Date :  ", "Type :  ", "Weight :  ");
	$qrid = serialize($id);
	for ($x = 0; $x < sizeof($id); $x++) {
	$sql = "SELECT Account.Acc_email, Shipment.OrderID,Shipment.OrderDate,Shipment.p_type,Shipment.p_weight
						FROM Shipment INNER JOIN Account
						ON  Shipment.R_id = Account.acc_ID WHERE Shipment.OrderID='$id[$x]';";
	$acc = mysqli_query($conn,$sql);
	$link = 'pdfeach.php?orderid='.$id[$x];
	while ($ac = mysqli_fetch_array($acc))
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
			newIframe.src = " qrcode.php?orderid='.$id[$x].' "; 
			iDiv.appendChild(newIframe);
			
			var ibutton = document.createElement("button");
			ibutton.className = "btn";
			ibutton.id = "'.$id[$x].'";
			ibutton.innerHTML = "PDF "
			cols.appendChild(ibutton);
			
			
			var ispan = document.createElement("span");
			ispan.className = "glyphicon glyphicon-download";
			ibutton.appendChild(ispan);
			
			document.getElementById("'.$id[$x].'").onclick = function () {
			location.href = "pdfeach.php?orderid='.$id[$x].' ";
		};
		});
		
		</script>';
	}}
?>
<body>
	<div id="content-shipment">
	<h2>Shipment Receipt</h2>
		<div class="row" id ="aa" >
			<div class="col-lg-12"  id = "col">
			</div>
		</div>
	</div>
	<div id="footer">
		<span>Copyright &copy; 2015. All Rights Reserved </span>
		<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
	</div>
	</body>
</html>

