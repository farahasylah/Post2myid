<?php include("sources.php");  ?>
<html><head>
	<title>Shipment History</title>
</head><body>
	<?php
	if(!isset($_SESSION["Member"]))
		{	header("Location: Login.php"); 	}
	else
		{	$Member = $_SESSION["Member"];	}
	$sql = "SELECT Account.Acc_email, Shipment.*
				FROM Shipment INNER JOIN Account
				ON  Shipment.R_id = Account.acc_ID WHERE Shipment.S_id='$Member' ORDER BY OrderDate DESC;";
	$result = mysqli_query($conn,$sql);
	if (!$result){	die( mysqli_error());	}
			
?>
	<div id="content-shipment">
	<div class="panel panel-default">
	<div class="panel-heading"><h2> My Shipment History </h2></div>
	<div class="panel-body">
	</br>
		<table class="table table-bordered">
			<tr>
				<th>Order ID</th>
				<th>Order Date</th>
				<th>Shipment type</th>
				<th>Shipment weight</th>
				<th>Recipient</th>
				<th>Status</th>
				<th>File</th>
			</tr>
		<?php while($rows=mysqli_fetch_assoc($result)){ ?>
			<tr>
			<td> <?php echo $rows['OrderID']; ?> </td>
			<td> <?php echo $rows['OrderDate']; ?> </td>
			<td> <?php echo $rows['p_type']; ?> </td>
			<td> <?php echo $rows['p_weight']; ?> </td>
			<td> <?php echo $rows['Acc_email']; ?> </td>
			<td> <?php echo $rows['status']; ?> </td>
			<?php $link = 'pdfeach.php?orderid='.$rows['OrderID'];		?>
			<td><button type="button" onClick="location.href ='<?php echo $link ?>' " class = "btn" > 
			PDF <span class="glyphicon glyphicon-download" ></span></button></td>
			</tr>
		<?php }?>
		</table>
	</br></br>
	</div></div>
</div>
	<div id="footer">
		Copyright &copy; 2015. All Rights Reserved 
		<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
     </div>
	</body>
</html>
