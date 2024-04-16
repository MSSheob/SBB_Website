<?php
 $servername ="db5000861878.hosting-data.io";
// "db5000845555.hosting-data.io";
$username1 = "dbu1139639";
//"dbu201332";
$password1 = "Websitesbb@123";
	//"Sbbwebsite@123";
$dbname = "dbs758609";
	//"dbs745756";

$conn = mysqli_connect("db5000861878.hosting-data.io","dbu1139639","Websitesbb@123","dbs758609");
	//("db5000855026.hosting-data.io","dbu982835","SBBwebsite@123","dbs753255");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
else {
//echo 'connected';
}
?>