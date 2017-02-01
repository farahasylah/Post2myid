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
	$("#sub").click(function () {
			
		  var cboxes = document.getElementsByName('checkedID[]');
		 
			var len = cboxes.length;
			var rep = ""
			for (var i=0; i<len; i++) {
				if(cboxes[i].checked){
					rep = document.getElementById(cboxes[i].value).innerHTML + "," +rep;
				}
			}
		document.getElementById("recp").innerHTML =rep;
		document.getElementById("itemdisplay").innerHTML = document.getElementById("type").value;
		document.getElementById("weightdisplay").innerHTML = document.getElementById("weight").value;
		$("#home").hide(); // this deactivates the home tab
		$('#tabs a[href="#menu1"]').tab('show'); // Select tab by name
		$("#menu1").show();
	});
	$("#edit").click(function () {
			$("#menu1").hide();// this deactivates the home tab
			$('#tabs a[href="#home"]').tab('show');  // Select tab by name
			$("#home").show();
	});
});
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
	if ($getFren = mysqli_query($conn, $sql)){ 
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
			<p><label> Item </label>
				<span class = "retrievebox">1</span></p>
			<p><label> Type &nbsp; : &nbsp;&nbsp;  </label> 
				<input type = "text" name = "type" id = "type"class = "inputbox" style="position: relative;"/></p>
			<p><label> Weight &nbsp; : &nbsp;  </label>
				<input type = "text" id="weight" name = "weight" class = "inputbox" style="position: relative;" /> g</p>
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
						<input id = "checkb" type="checkbox"  name="checkedID[]" value="<?php echo $row[0]; ?>">
						<span style="margin-right:10px" id = "<?php echo $row[0]; ?>" value="<?php echo $row[1]; ?>"><?php echo $row[1]; ?></span>
					</label>  
				</div>
				</td></tr>
				<?php }} ?>
			</table>
		</div></br>
		<button type="button" id = "sub" class = "btn" >Submit</button></br>
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
			<p><label> Item </label>
				&nbsp; :<span class = "retrievebox" id="itemdisplay"  name="itemdisplay"></span></p>
			<p><label> Weight </label>
				&nbsp; :<span class = "retrievebox" id="weightdisplay" name="weightdisplay"></span>g</p>
		</div>
		</div>		
		<div class="col-lg-6" >
		<div class="well">
			<h3>Sender information</h3>
			<p><span class = "retrievebox">
				<?php echo $rows['firstname']," ",$rows['lastname']; ?></span></p>
			<p><span class = "retrievebox">
				<?php echo $rows['street_address']; ?> </br>
				<?php echo $rows['postcode'],",",$rows['city']; ?> </br>
				<?php echo $rows['country']; ?></span></p>
			<p><span class = "retrievebox">
				<?php echo $rows['Acc_email']; ?></span></p>
			<p><span class = "retrievebox">
				<?php echo $rows['phone_no']; ?></span></p>
		</div>
		<div class="row">
		<div class="col-lg-12" >
		<div class="well">
			<p><label> Recipient </label>
				&nbsp; :<span class = "retrievebox" id="recp"></span></p>
		</div>
		</div>
		</div>
	</div>
</div>
<?php } ?>
	<input  type="submit" id = "confirm" name="submit" value="Confirm" class = "btn">
	<button type="button" id = "edit" class = "btn"  >Edit</button>
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

<?php 
if(isset($_POST['submit'])) {
	$R_id = $_POST['checkedID'];
	$p_type = $_POST['type'];
	$p_weight = $_POST['weight'];
	//$a=array();
	$orderid=array();
    foreach($R_id as $id){
		$query = "INSERT INTO Shipment (OrderID,OrderDate,p_weight,p_type,S_id,R_id)
				  VALUES (NULL,CURRENT_TIMESTAMP, '$p_weight', '$p_type', '$Member', '$id');";
		$result = mysqli_query($conn, $query);
		if (!$result){
			die("Failed" . mysql_error());
		}
		else{
			$last_id = mysqli_insert_id($conn);
			array_push($orderid,$last_id);
		}	
    }
	$qrid = serialize($orderid);
	echo '<script language = "Javascript">
				window.location = "ship-receipt.php?orderid='.$qrid.' "</script>';
}
?>

