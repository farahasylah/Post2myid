<?php include("sources.php"); ?>
<html>
<head>
	<title>Profile</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
	  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMhmkThgiu1mNBP6PuuN4NZbIsBQLBWjg&libraries=places&callback=initAutocomplete"
        async defer></script>

	<script type="text/javascript" src="js/jquery.validate.js"></script>
</head>
<script> //Google API
      var placeSearch, autocomplete;
      var componentForm = {
        street_number: 'long_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete() {
        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
            {types: ["geocode", "establishment"]});

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', fillInAddress);
      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();
		

        for (var component in componentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        // Get each component of the address from the place details
        // and fill the corresponding field on the form.
		var fullAddress = [];
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById(addressType).value = val;
          }
			if (addressType == "street_number") {
				fullAddress[0] = val;
			} else if (addressType == "route") {
				fullAddress[1] = val;
			}
		}
		document.getElementById('name').value = fullAddress.join(" ");
		if (document.getElementById('name').value !== "") {
		  document.getElementById('name').disabled = false;
        }
      }

      // Bias the autocomplete object to the user's geographical location,
      // as supplied by the browser's 'navigator.geolocation' object.
      function geolocate() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
              center: geolocation,
              radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
          });
        }
      }
	  google.maps.event.addDomListener(window, 'load', initAutocomplete)
    </script>
<script type = "text/javascript" language = "javascript">
 $(document).ready(function() {
 	$("#accNav").attr("class", "disabled");
	$( ".accNav" ).append( "<div class='down' style='left: 40;'></div>" );
   $( ".editable" ).prop( "disabled", true );
	$( ".editable" ).css("border", "none");
	$( ".editable" ).css("background-color", " #E0E0E0");
	$("#hint").hide();
 
 $("#edit").click(function () {
		$("#hint").show();
		$("#save").show();
		   $( ".editable" ).prop( "disabled", false );
		   $( ".editable" ).css("border", "1px solid #d1c7ac");
		   	$( ".editable" ).css("background-color", "cornsilk");
           $("#addressform").show();
	 });
	
	$("#validate-form").validate({
	//specify the validation rules
	rules: {
	firstname: "required",
	lastname: "required",
	tel: "required",
	},
	//specify validation error messages
	messages: {
	firstname: "field cannot be blank!",
	lastname: "field cannot be blank!",
	tel: "field cannot be blank!",
	},
	 
	submitHandler: function(form){
	form.submit();
	}
	});
});
</script>

<body>
	<?php
		if(!isset($_SESSION["Member"])) 
		{	header("Location: Login.php"); 	}
		else
		{	$Member = $_SESSION["Member"];	}
			$sql = "SELECT * FROM `Account` WHERE `acc_ID` ='$Member'";
			$result = mysqli_query($conn,$sql);
			while($rows=mysqli_fetch_array($result)){  ?>
	<div id="content-shipment">
	<div class="row">
	<div class="col-lg-10 col-md-10 col-xs-12" >
	<div class="panel panel-default">
	<div class="panel-heading"><h2> My Profile </h2></div>
	<div class="panel-body">
	<form class = "Profile" method="post" name ="account" id="validate-form">
			<div class="list-group">
			<ul class="list-group">
				  <li class="list-group-item"> 
						<label> Account ID  </label>&nbsp; :
						<span ><?php echo $rows['acc_ID'];  ?></span></li>
					<li class="list-group-item">
						<label> Email address  </label>&nbsp; :
						<span name="email"  ><?php echo $rows['Acc_email'];  ?></span></li>
				  <li class="list-group-item">
						<label>  First Name  </label>&nbsp; :
						<input type = "text" name = "firstname" class = "editable" value="<?php echo $rows['firstname'];  ?>" /></li>
				  <li class="list-group-item"> 
						<label>  Last Name  </label>&nbsp; :
						<input type = "text" name = "lastname" class = "editable"  value="<?php echo $rows['lastname'];  ?>" /></li>
					<li class="list-group-item">
						<label> Phone No </label>&nbsp; :
						<input  type = "tel" name = "tel" class = "editable"  value="<?php echo $rows['phone_no'];  ?>" /></li>
					<li class="list-group-item">
						<label >Address </label>&nbsp; :
						<div id="locationField">
							<input class = "editable"  id="autocomplete" placeholder="Enter your address"onFocus="geolocate()" 
							type="text" value="<?php echo $rows['street_address'].', '.$rows['postcode'].' '.$rows['city'].', '.$rows['country'];  ?>"></input>
							<p id ="hint" style="font-size:11px;float:right;">search here on Google Map</p>
						</div>
					</li>
					<li class="list-group-item">
					<div id = "addressform"  style="display:none;"></br>
					<fieldset>
					<p><label> Building Name &nbsp; : </label>
						<input name="name" class = "inputbox" class="field" type="text" id="name" 
						 type="text"> </p>
					<p><label> Street &nbsp; : </label>
						<input name="street_number" class = "inputbox" class="field" id="street_number"  
							 type="text" value="<?php echo $rows['street_address']?>"></input></p>
					<p><label> &nbsp;  </label>
						<input name="route" class = "inputbox"  class="field"  id="route"
							 type="text" ></p>
					<p><label> City &nbsp; : </label>
						<input name="locality" class = "inputbox"   class="field" id="locality" 
						 type="text" value="<?php echo $rows['city']?>"></p>
					<p><label>State &nbsp; : </label>
						<input name="administrative_area_level_1" class = "inputbox"  class="field" 
						id="administrative_area_level_1"  type="text"  ></p>
					<p><label> Postal Code &nbsp; : </label>
						<input name="postal_code" class = "inputbox"  class="field" id="postal_code" 
						 value="<?php echo $rows['postcode']?>"></p>
					<p><label>Country &nbsp; : </label>
						<input name="country" class = "inputbox"  class="field" id="country"  
						 type="text"  value="<?php echo $rows['country']?>"></p>
					</fieldset>
					</div>
					</li>
		</ul></div>
	<input type="submit" id = "save" name="submit" class = "btn" value="Save" style="display:none"/>
	<?php } ?>
 </form>
	</div> 
	</div>
	</div>
	<div class="col-lg-2 col-md-2 col-xs-12" >
		<button type="button" class = "btn" id ="edit" ><span class="glyphicon glyphicon-edit"></span> Edit Profile</button>
	<button type="button" class = "btn" id ="edit" onClick="parent.location='ShipmentHistory.php' "><span class="glyphicon glyphicon-book"></span> Shipment history</button>
	</div>
	</div>
</div>
		
<div id="footer">
	Copyright &copy; 2015. All Rights Reserved 
	<span style = "float:right">Online ID to Physical Postal Address | Project 144</span>
</div>
</body></html>

<?php 
if(isset($_POST['submit']))
{
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$street_address = $_POST["name"];
	$tel = $_POST["tel"];
	$postcode = $_POST["postal_code"];
	if(empty($_POST['locality']))	{	
	$city = $_POST["administrative_area_level_1"];		}
	else{
	$city = $_POST["locality"].' , '.$_POST["administrative_area_level_1"];	}
	$country = $_POST["country"];
	
	$update = "UPDATE `Account` SET 
	`firstname` = '$firstname',
	`lastname`= '$lastname',
	`phone_no` = '$tel', 
	`street_address` =  '$street_address', 
	`postcode` = '$postcode',
	`country` = '$country',
	`city` = '$city' 	
	WHERE `acc_ID` = '$Member' ;"; 	 
	$result = mysqli_query($conn, $update); 
	if (!$result){
		die("Failed" . mysql_error());
	}
	else{
	echo "<script>window.location.href='Account.php'</script>";
	}
}
?>
