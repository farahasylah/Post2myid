<?php include("sources.php");  ?>
<html>
<head><title>Home</title></head><body>
<script>
	$(document).ready(function(){
		$("#homeNav").attr("class", "disabled");
		$( ".homeNav" ).append( "<div class='down' style='left: 35;'></div>" );
	});
</script>
	<div id="content-home">
		<p style="padding:30px;font-family: Verdana;" class="desc">
			Post2myID provides your shipment process easier and faster by having a unique id that represents 
			the sender,recipient's address and all required information to send your parcel or mail.
			No more hassle at the post station, just flash your QR code!</p><hr>
	<div class="row" style="background: beige;border-radius: 40px;">
		<div class="col-lg-4 col-md-4 col-xs-4">
		  <div class="stepshome" >
			<span class="glyphicon glyphicon-edit" id="largeicon"></span>
			<h3>Fill in parcel information</h3>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-xs-4">
			<div class="stepshome">
				<span class="glyphicon glyphicon-user " id="largeicon"></span>
				<h3>Select recipients</h3>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-xs-4">
			<div class="stepshome">
				<span class="glyphicon glyphicon-qrcode" id="largeicon"></span>
				<h3>Ready to go!</h3>
			</div>
		</div>
	</div>
<hr>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-xs-12" >
		<div class="panel panel-default" style="background: rgb(224, 224, 224);">
		<div class="panel-body">
		<div class="stepshome">
			<span class="glyphicon glyphicon-phone" id="largeicon"></span>
		   <h3>Also available on the app!</h3>
		    <button type="button"  class = "btn" id="bigbtn" onClick="parent.location='Post2myID.apk' ">
			<span style="font-size: 30px" class="glyphicon glyphicon-download" ></span></button>
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

