<?php
	session_start();
	session_destroy(); 
	echo '<script type="text/javascript">alert("Logout Successful");
			</script>';
		echo '<script language = "Javascript">
				window.location = "home.php"</script>';
	exit();
?>