<?php
  
$conn = mysqli_connect("db5000861878.hosting-data.io","dbu1139639","Websitesbb@123","dbs758609");
	//("db5000855026.hosting-data.io","dbu982835","SBBwebsite@123","dbs753255");
?>
<?php
if(isset($_GET["id"])) {
	$id = $_GET["id"];
$sql = "UPDATE quick_cv SET Savings_Full_Time_Hire='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
  header("Location: https://skillbeyondboundaries.com/quickcva/");
} else {
  header("Location: https://skillbeyondboundaries.com/quickcva/");
}
}
$conn->close();
	
?>