<?php

$db_host = "localhost";
$db_database = "postmyid_account";
$db_user = "root";
$db_password = "";

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database);

if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
session_start();

?>