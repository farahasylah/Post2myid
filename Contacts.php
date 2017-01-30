<?php  include("sources.php"); ?>
<html>
<script>
$(document).ready(function(){
	$("#cNav").attr("class", "disabled");
	$( ".cNav" ).append( "<div class='down' style='left: 60;'></div>" );
});
function confirmDelete(){
	var result = confirm("Are you sure to delete these contacts?");
	if(result){
		return true;
	}else{
		return false;
	}
}
</script>
<style>
		down{
			border-left-width: 90px;
			border-right-width: 90px;
		}
	</style>
<head>
	<title>Contacts List</title>  
</head>
	<body>
	<?php
	if(!isset($_SESSION["Member"]))
		{	header("Location: Login.php"); 	}
	else
		{	$Member = $_SESSION["Member"];	}
			$sql = "SELECT acc_ID,`Acc_email` FROM `Account` 
			WHERE `acc_ID` IN 
			(SELECT `R_id` FROM `Contacts` 
			WHERE `S_id` ='$Member')";
	if ($result = mysqli_query($conn, $sql))
		{ 
	?>
	
	<div id="content-shipment">
	
	<div class="row">
	<form name="deleteContact" method="post" onSubmit="return confirmDelete();"/>
	<div class="col-lg-10 col-md-10" >
	<div class="panel panel-default">
	<div class="panel-heading"><h2>Contact List </h2></div>
	<div class="panel-body">
		<table class="table table-hover">
		<thead>
			<tr>
				<th>Email address</th>
			</tr>
		</thead>
<?php while($row=mysqli_fetch_row($result)){  ?>
			<tr><td style="padding:0px">
				<div class="checkbox"  style="margin:0px">
					<label  style="width:100%;padding:10px 50px;text-align:left;">
					<input type="checkbox"  name="checkedID[]"value="<?php echo $row[0]; ?>">
					<span  style="margin-right:10px" ><?php echo $row[1]; ?></span>
					</label>  
				</div>
			</td> </tr>
<?php }} ?>
		</table>
	</div> 
  	</div>
	</div>
		<div class="col-lg-2 col-md-2" >
			<input type="submit" class="btn btn-danger" name="submitDelete" value="Delete"/>
			</br></br>
			<button type="button"  class = "btn" onClick="parent.location='AddContact.php' ">Add Contact</button>
		</div>
	</form>
	</div>
</div>
	<div id="footer">
		Copyright &copy; 2015. All Rights Reserved 
		<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
     </div>
	</body>
</html>

<?php 
	if(isset($_POST['submitDelete'])){
    $R_id = $_POST['checkedID'];
    foreach($R_id as $id){
		$delete ="DELETE FROM contacts WHERE R_id='$id' AND  S_id ='$Member'";
		$result = mysqli_query($conn, $delete);
    }
	
	echo "<script>window.location.href='Contacts.php'</script>";
}