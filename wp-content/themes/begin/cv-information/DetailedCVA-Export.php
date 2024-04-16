<?php
$conn = mysqli_connect("db5000855026.hosting-data.io","dbu982835","SBBwebsite@123","dbs753255");
?>
<?php
if(isset($_GET["id"])) {
	$id = $_GET["id"];
$sql = "UPDATE detailed_cva SET Savings_Full_Time_Hire='NA', Savings_Contract_Consulting_PartTIme='NA', Savings_Reassignmetn_Retrenchment='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
	// echo "Record updated successfully";
  header("Location: https://skillbeyondboundaries.com/detailedcva/");
} else {
  header("Location: https://skillbeyondboundaries.com/detailedcva/");
}
}
$conn->close();
	
?>