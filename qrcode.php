<?php
$OrderID = $_GET["orderid"];
include("connect.php"); 
	$sql = "SELECT Account.Acc_email, Shipment.*
				FROM Shipment INNER JOIN Account
				ON  Shipment.R_id = Account.acc_ID WHERE Shipment.OrderID='$OrderID';";	
	$result = mysqli_query($conn,$sql);
	$link = 'pdfeach.php?orderid='.$OrderID;
	while($rows=mysqli_fetch_array($result)){ 
	$codeContents  = 'Order ID = ' .$OrderID. ' Date & Time = ' .$rows['OrderDate'].  ' Recipient  Email = ' .$rows['Acc_email']. ' Sender ID = ' .$rows['S_id'];
    }
	
include('phpqrcode/qrlib.php');
    $tempDir = 'D:/XAMPP/htdocs/public_html/phpqrcode/Shipment/'; 
	$tempURL = 'phpqrcode/Shipment/';
	$fileName = $OrderID.'.png'; 
   
    $pngAbsoluteFilePath = $tempDir.$fileName; 
    $urlRelativeFilePath =  $tempURL.$fileName; 
  
    if (!file_exists($pngAbsoluteFilePath)) { 
        QRcode::png($codeContents, $pngAbsoluteFilePath, 'h', 4,1, false); 
    } 
?>
<html>
	<link rel="stylesheet" href="style.css" type="text/css">
<style>
#container{
	border-radius:0;
	padding:4px 0px;
 }
.header{
float:none;
}
img[name=logo]{
	float:none;
}
.receipt{
border: 2px solid  #06AE9B;
text-align:center;
padding-bottom:20px;
}
body{
	padding-left:0px;
	padding-right:0px;
}
</style>

<div class="receipt">
	<div id="container">
		<img src="postage_stamp.png" name = "logo" alt="mail" style="width:60px;height:60px;" ></br>
		<span class = "header" style="font-size: 15px;"=>Post2myID</span>	
	</div>
	</br>
	<?php echo '<img src="/public_html/phpqrcode/Shipment/'.$fileName.' " >';  ?>
</div>
</html>
