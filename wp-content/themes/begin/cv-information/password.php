<?php
if(!empty($_POST["id"])){ 
	$id  = $_POST["id"];
	echo "fffffffffffffffff". $id;
	$cva  = $_POST["cva"];
	
  $conn = mysqli_connect("db5000861878.hosting-data.io","dbu1139639","Websitesbb@123","dbs758609");
	//echo "val: " . $cva;
if($cva == "quick"){ 
	$sql = "UPDATE quick_cv SET Savings_Full_Time_Hire='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE  id='$id'";
}
elseif($cva == "detailed"){ 
		$sql = "UPDATE detailed_cva SET Savings_Full_Time_Hire='NA', Savings_Contract_Consulting_PartTIme='NA', Savings_Reassignmetn_Retrenchment='NA', Revenue_Placement_Of_Bench='NA', Total_Value='NA', Net_Profit_Percentage='NA' WHERE id='$id'";
}
	if ($conn->query($sql) === TRUE) {
 // header("Location: http://dev.skillbeyondboundaries.com/quickcva/");
}

}
?>
