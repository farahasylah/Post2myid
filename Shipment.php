<?php	include("sources.php"); ?>
<html>
<head>
	<title>Create Shipment</title>
	<link rel="stylesheet" href="css/token-input.css" type="text/css" />
	<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.js"></script>
<script type = "text/javascript" language = "javascript">
$(document).ready(function() {
	$("#shipNav").attr("class", "disabled");
	$( ".shipNav" ).append( "<div class='down' style='left: 70;'></div>" );
	$("#validate-form").validate({
			//specify the validation rules
			rules: {
				type: "required",
				query: "required",
				weight: {
				  required: true,
				  number: true,
				}
				},
				 submitHandler: function(form){
					form.submit();
				}
		});
		$("#home").show();
	  $("#search").click(function () {
            alert("Would submit: " + $(this).siblings("#demo-input-prevent-duplicates").val());
//document.getElementById("contacts").innerHTML =$("#demo-input-prevent-duplicates").val() ;
});	});
</script>
</head>
	<style>
	down{
		border-left-width: 90px;
		border-right-width: 90px;
	}
	</style>
	<body>
	<?php
		if(!isset($_SESSION["Member"])) 
		{	header("Location: Login.php");	 }
		else
		{	$Member = $_SESSION["Member"];	}	
		$sql = "SELECT acc_ID,`Acc_email` FROM `Account` 
			WHERE `acc_ID` IN 
			(SELECT `R_id` FROM `Contacts` 
			WHERE `S_id` ='$Member')";
	
	if ($getFren = mysqli_query($conn, $sql))
		{ 
	?>
	<div id="content-shipment" >
	<div class="panel panel-default">
			<div class="panel-heading"><h2>Create a shipment</h2>
				<p>Create your shipment - the easiest and fastest way</p></div>
	<div class="panel-body">
	<div class="row" style="margin:0px !important">
	<div class="col-lg-12 col-md-12 col-xs-12" >
	<ul class="nav nav-tabs nav-justified" id="tabs">
    <li class="active"><a href="#home"><h3>1</h3> Fill up form</a></li>
    <li ><a  href="#menu1" ><h3>2</h3> Confirm Shipment</a></li>
   </ul>
   </br>
   
 <div class="tab-content" >
 <form class="Confirm" method="post" id = "validate-form" > 
    <div id="home" class="tab-pane fade in active" style="display:none">
       <div class="col-sm-6" >
			<div class="well well-lg"  id="well" >
				<p>
					<label> Item </label>
					<span class = "retrievebox">1</span>
				</p>
				<p>
					<label> Type &nbsp; : &nbsp;&nbsp;  </label> 
					<input type = "text" name = "type" id = "type"class = "inputbox" style="position: relative;"/>
				</p>
				<p>
					<label> Weight &nbsp; : &nbsp;  </label>
					<input type = "text" id="weight" name = "weight" class = "inputbox" style="position: relative;" /> g
				</p>
			</div>
		</div>
		<div class="col-sm-6" >
			<div class="well well-lg" id="well">
				<p><label> Select Contact  </label>	&nbsp; :  </p>
				<span id="contacts" style="display:none"></span>
				<table>
				<?php while($row=mysqli_fetch_row($getFren)){  ?>
				<tr><td style="padding:0px">
					<div class="checkbox"  style="margin:0px">
						<label  style="width:100%;padding:10px 50px;text-align:left;">
						<input id = "checkb" type="checkbox"  name="checkedID[]"value="<?php echo $row[0]; ?>">
						<span  style="margin-right:10px" ><?php echo $row[1]; ?></span>
						</label>  
					</div>
				</td></tr>
				<?php }} ?>
				</table>
			</div></br>
			<button type="button" id = "sub" class = "btn" >Submit</button></br>
			<script type="text/javascript">
						$(document).ready(function() {
						 $("#sub").click(function () {
									document.getElementById("recp").innerHTML =document.getElementById("checkb").value;
									document.getElementById("itemdisplay").innerHTML = document.getElementById("type").value;
									document.getElementById("weightdisplay").innerHTML = document.getElementById("weight").value;
									$("#home").hide(); // this deactivates the home tab
									$('#tabs a[href="#menu1"]').tab('show'); // Select tab by name
									$("#menu1").show();
						});
						});
				</script>
			</div>
    </div>
	
    <div id="menu1" class="tab-pane fade" style="display:none" >
     <?php
		$sql = "SELECT * FROM `Account` WHERE `acc_ID` ='$Member'";
		$result = mysqli_query($conn,$sql);
		while($rows=mysqli_fetch_assoc($result)){ 
	?>
	<div class="row">
		<div class="col-lg-6" >
		<div class="well">
			<p>
			<label> Item </label>
			&nbsp; :<span class = "retrievebox" id="itemdisplay"  name="itemdisplay"></span></p>
			<p>
			<label> Weight </label>
			&nbsp; :<span class = "retrievebox" id="weightdisplay" name="weightdisplay"></span>g</p>
		</div>
		</div>		
		<div class="col-lg-6" >
		<div class="well">
			<h3>Sender information</h3>
			<p>
				<span class = "retrievebox">
				<?php echo $rows['firstname']," ",$rows['lastname']; ?></span></p>
			<p>
				<span class = "retrievebox">
				<?php echo $rows['street_address']; ?> </br>
				<?php echo $rows['postcode'],",",$rows['city']; ?> </br>
				<?php echo $rows['country']; ?></span></p>
			<p>
				<span class = "retrievebox">
				<?php echo $rows['Acc_email']; ?></span></p>
			<p>
				<span class = "retrievebox">
				<?php echo $rows['phone_no']; ?></span></p>
		</div>
		<div class="row">
		<div class="col-lg-12" >
		<div class="well">
			<p>
				<label> Recipient </label>
				&nbsp; :<span class = "retrievebox" id="recp">
				</span>
			</p>
		</div>
		</div>
		</div>
	</div>
</div>
<?php } ?>
	<input  type="submit" id = "confirm" name="submit" value="Confirm" class = "btn">
	<button type="button" id = "edit" class = "btn"  >Edit</button>
	<script type="text/javascript">
		$(document).ready(function() {
		$("#edit").click(function () {
			$("#menu1").hide();// this deactivates the home tab
			$('#tabs a[href="#home"]').tab('show');  // Select tab by name
			$("#home").show();
		});
	});	</script>
 </div>
 </form>
  </div>
</div>
</div>
</div>
</div>
</div>
	
<div id="footer">
	Copyright &copy; 2015. All Rights Reserved 
	<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
 </div>
</body></html>
<script>
	function printContent(el){
		var restorepage = document.body.innerHTML;
		var printcontent = document.getElementById(el).innerHTML;
		document.body.innerHTML = printcontent;
		window.print();
		document.body.innerHTML = restorepage;	}
</script>

<?php 
if(isset($_POST['submit'])) {
	$R_id = $_POST['checkedID'];
	$p_type = $_POST['type'];
	$p_weight = $_POST['weight'];
	$a=array();
    foreach($R_id as $id){
		$query = "INSERT INTO `Shipment` (`OrderDate`,`p_weight`, `p_type`, `S_id`, `R_id`)
				  VALUES (CURRENT_TIMESTAMP, '$p_weight', '$p_type', '$Member', '$id');";
		$result = mysqli_query($conn, $query);
		//$id = mysqli_insert_id();
		array_push($a,$id);
    }
	//$orderid = serialize($a);
//	$id = unserialize($orderid);
	$names = array("Recipient email :  ", "Order ID :  ", "Order Date :  ", "Type :  ", "Weight :  ");
	$qrid = serialize($a);
	//$id = $_GET["a"];
	//print_r($id);
	//echo $id[0].'==';	newIframe.src = " http://post2myid.tk/qrcode.php?orderid='.$id[$x].' '"; 
//	echo $id[1].'<<';
	foreach($R_id as $id){
	$sql = "SELECT Account.Acc_email, Shipment.OrderID,Shipment.OrderDate,Shipment.p_type,Shipment.p_weight
						FROM Shipment INNER JOIN Account
						ON  Shipment.R_id = Account.acc_ID WHERE Shipment.OrderID='$id';";
	$acc = mysqli_query($conn,$sql);
	while ($ac = mysqli_fetch_array($acc))
    {
	echo '<script language = "Javascript">
		$(document).ready(function() {
		$("#validate-form").hide();
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
			newIframe.src = " http://post2myid.tk/qrcode.php?orderid='.$id.' "; 
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
}
?>

