<?php
//error_reporting(ALL);
//include 'config.php';
//require 'PHPMailerAutoload.php';
error_reporting(0);
 session_start();

 $servername = "db5000861878.hosting-data.io";
//"db5000855026.hosting-data.io";
$username1 = "dbu1139639";
//"dbu982835";
$password1 = "Websitesbb@123";
	//"SBBwebsite@123";
$dbname = "dbs758609";
	//"dbs753255";

$conn = mysqli_connect("db5000861878.hosting-data.io","dbu1139639","Websitesbb@123","dbs758609");
	//("db5000855026.hosting-data.io","dbu982835","SBBwebsite@123","dbs753255");



if(isset($_POST['submit'])){
 $company_name = $_POST['QuickCVA_company_name'];
 
 // echo $company_name;
 $industry = $_POST['QuickCVA_industry'];
 $email = $_POST['email'];
 
$Name = $_POST['Name'];
 $Designation = $_POST['Designation'];
 $Phone = $_POST['Phone'];

 $recruitments_third_parties = $_POST['recruitments_third_parties'];
 $QuickCVA_planned_recruitments = $_POST['QuickCVA_planned_recruitments'];
 $QuickCVA_Average_cost = $_POST['QuickCVA_Average_cost'];

 //$QuickCVA_Average_recruitment = $_POST['QuickCVA_Average_recruitment'];
	$QuickCVA_Average_recruitment = preg_replace('/[^0-9. -]/', '', $_POST['QuickCVA_Average_recruitment']);
	//echo "test".$QuickCVA_Average_recruitment;
	
 $QuickCVA_average_referral_fees_paid = $_POST['QuickCVA_average_referral_fees_paid'];
 $QuickCVA_Annual_bench_employees = $_POST['QuickCVA_Annual_bench_employees'];

 $QuickCVA_Average_overheads = $_POST['QuickCVA_Average_overheads'];
 //$QuickCVA_desired_markup = $_POST['QuickCVA_desired_markup'];
	 $QuickCVA_desired_markup = preg_replace('/[^0-9. -]/', '', $_POST['QuickCVA_desired_markup']);
	//echo "QuickCVA_desired_markup".$QuickCVA_desired_markup;
 $QuickCVA_Annual_bench = $_POST['QuickCVA_Annual_bench'];
 
 
 $One = 1;
 //echo "QuickCVA_Average_recruitment".$QuickCVA_Average_recruitment;
 //$Savings_Full_Time_Hire =  $_POST['recruitments_third_parties'] * $_POST['QuickCVA_Average_cost'] * $QuickCVA_Average_recruitment/100; //by Ratnakar on 07 - oct - 2020
$Savings_Full_Time_Hire =  $_POST['recruitments_third_parties'] * $_POST['QuickCVA_Average_cost'] * $QuickCVA_Average_recruitment/100 + $_POST['QuickCVA_planned_recruitments'] * $_POST['QuickCVA_average_referral_fees_paid'];

  // echo   "Savings_Full_Time_Hire".$Savings_Full_Time_Hire;
 //$Revenue_Placement_Of_Bench =  $_POST['QuickCVA_Annual_bench_employees']*$_POST['QuickCVA_Average_overheads']*($One+$QuickCVA_desired_markup/100); 
//by Ratnakar on 07 - oct - 2020
 $Revenue_Placement_Of_Bench =   $_POST['QuickCVA_Annual_bench_employees']*( $_POST['QuickCVA_Average_cost'] + $_POST['QuickCVA_Average_overheads']) * ($One+$QuickCVA_desired_markup/100); 
 
 // echo  "QuickCVA_Annual_bench_employees".$QuickCVA_Annual_bench_employees; 
  //  echo  "QuickCVA_Average_overheads".$QuickCVA_Average_overheads; 
	//  echo  "QuickCVA_desired_markup".$QuickCVA_desired_markup; 
 //echo  "Revenue_Placement_Of_Bench".$Revenue_Placement_Of_Bench; 
 $Total_Value = $Savings_Full_Time_Hire + $Revenue_Placement_Of_Bench;
 if($QuickCVA_Annual_bench == 0) {$Net_Profit_Percentage='NA';}
 else { $Net_Profit_Percentage = $Total_Value/$QuickCVA_Annual_bench;
  $Net_Profit_Percentage =$Net_Profit_Percentage *100;
	 //   $Net_Profit_Percentage = round($Net_Profit_Percentage *100,2); 
   $Net_Profit_Percentage = round($Net_Profit_Percentage,2); 
 }
 	//number formatting of prices
	$Savings_Full_Time_Hire = number_format("$Savings_Full_Time_Hire");
	$Revenue_Placement_Of_Bench = number_format("$Revenue_Placement_Of_Bench"); 
	$Total_Value = number_format("$Total_Value"); 	 
	//ends number formatting here
 // echo "Total_Value".$Total_Value;
 // $query= "INSERT INTO `quick_cv` (`id`, `company_name`, `industry`, `email`,
//`Name`, `Designation`, `Phone` ,`Savings_Full_Time_Hire`,  `Revenue_Placement_Of_Bench`, `Total_Value`, `Net_Profit_Percentage`) VALUES (NUll, //'$company_name', '$industry', '$email',   
//  ,'$Name','$Designation','$Phone','$Savings_Full_Time_Hire','$Revenue_Placement_Of_Bench','$Total_Value','$Net_Profit_Percentage')";


 $query= "INSERT INTO `quick_cv` (`id`, `company_name`, `industry`, `email`, `recruitments_third_parties`, `QuickCVA_planned_recruitments`,  `QuickCVA_Average_cost`, `QuickCVA_Average_recruitment`, `QuickCVA_average_referral_fees_paid`, `QuickCVA_Annual_bench_employees`,  `QuickCVA_Average_overheads`, `QuickCVA_desired_markup`, `QuickCVA_Annual_bench`,`Name`, `Designation`, `Phone` ,`Savings_Full_Time_Hire`,  `Revenue_Placement_Of_Bench`, `Total_Value`, `Net_Profit_Percentage`) VALUES (NUll, '$company_name', '$industry', '$email',  NUll, NUll, NUll, NULL, NULL, NULL, NULL, NULL, NULL
  ,'$Name','$Designation','$Phone','$Savings_Full_Time_Hire','$Revenue_Placement_Of_Bench','$Total_Value','$Net_Profit_Percentage')";	
	
//echo $query;
	//$result = mysqli_query($conn,$query);
	

if ($conn->query($query) === TRUE) {  
	 $last_id = $conn->insert_id;
	$_SESSION['last'] = $last_id;
  //echo "New record created successfully. Last inserted ID is: " . $last_id;
   header("Location: https://skillbeyondboundaries.com/collaboration-value-potential-of-sbb-quick-cva/?success=ok");  

 }
else{
	//  echo "Not Successfully Submitted";
 header("Location: https://skillbeyondboundaries.com/quickcva/");  
	
}

}
?>