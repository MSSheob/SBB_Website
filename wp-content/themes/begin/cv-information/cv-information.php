<?php
include 'config.php';

session_start();

if(isset($_POST['submit'])){
	
$company_name = $_POST['company_name'];
 $industry = $_POST['industry'];
 $email = $_POST['email'];
$Name = $_POST['Name'];
 $Designation = $_POST['Designation'];
 $Phone = $_POST['Phone'];
 
 
 //echo $Phone;  //$recruitments_third_parties = preg_replace('/[^0-9. -]/', '',  $_POST['recruitments_third_parties']);
 //$escaped_string = preg_replace('/[^0-9. -]/', '', $test);
 $Planned_Recru_Third_Party_Zero_Five = $_POST['Planned_Recru_Third_Party_Zero_Five'];
 $Planned_Recru_Third_Party_Five_Tweleve = $_POST['Planned_Recru_Third_Party_Five_Tweleve'];
 $Planned_Recru_Third_Party_Tweleve_Eighteen  = $_POST['Planned_Recru_Third_Party_Tweleve_Eighteen'];
 $Planned_Recru_Third_Party_Eighteen_More= $_POST['Planned_Recru_Third_Party_Eighteen_More'];
 
 
 
 $Planned_Recru_Emp_Referral_Zero_Five = $_POST['Planned_Recru_Emp_Referral_Zero_Five'];
 $Planned_Recru_Emp_Referral_Five_Tweleve = $_POST['Planned_Recru_Emp_Referral_Five_Tweleve'];
 $Planned_Recru_Emp_Referral_Tweleve_Eighteen = $_POST['Planned_Recru_Emp_Referral_Tweleve_Eighteen'];
 $Planned_Recru_Emp_Referral_Eighteen_More = $_POST['Planned_Recru_Emp_Referral_Eighteen_More'];

   
 $Avg_CTC_Hire_PerAnnum_Zero_Five = $_POST['Avg_CTC_Hire_PerAnnum_Zero_Five'];
	//echo "Avg_CTC_Hire_PerAnnum_Zero_Five".$Avg_CTC_Hire_PerAnnum_Zero_Five;
 $Avg_CTC_Hire_PerAnnum_Five_Tweleve = $_POST['Avg_CTC_Hire_PerAnnum_Five_Tweleve'];
 $Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen = $_POST['Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen'];
 $Avg_CTC_Hire_PerAnnum_Eighteen_More = $_POST['Avg_CTC_Hire_PerAnnum_Eighteen_More'];
 
 
 /*for step - 2 allows decimal values*/
 $Avg_Recru_Charges_Third_Party_PerHire_Zero_Five =  preg_replace('/[^0-9. -]/', '', $_POST['Avg_Recru_Charges_Third_Party_PerHire_Zero_Five']);
	//echo "Avg_Recru_Charges_Third_Party_PerHire_Zero_Five".$Avg_Recru_Charges_Third_Party_PerHire_Zero_Five;
 $Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve =  preg_replace('/[^0-9. -]/', '', $_POST['Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve']);
 $Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen =  preg_replace('/[^0-9. -]/', '', $_POST['Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen']);
 $Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More = preg_replace('/[^0-9. -]/', '',  $_POST['Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More']);
  
   //echo "Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More".$Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More;
 

  $Avg_Reff_Fees_To_Emp_Zero_Five = $_POST['Avg_Reff_Fees_To_Emp_Zero_Five'];
 $Avg_Reff_Fees_To_Emp_Five_Tweleve = $_POST['Avg_Reff_Fees_To_Emp_Five_Tweleve'];
 $Avg_Reff_Fees_To_Emp_Tweleve_Eighteen = $_POST['Avg_Reff_Fees_To_Emp_Tweleve_Eighteen'];
 $Avg_Reff_Fees_To_Emp_Eighteen_More = $_POST['Avg_Reff_Fees_To_Emp_Eighteen_More'];
 
// echo "Avg_Reff_Fees_To_Emp_Eighteen_More".$Avg_Reff_Fees_To_Emp_Eighteen_More;
 
  $Contractual_hires = $_POST['Contractual_hires'];  //40
 $contract_per_annum = $_POST['contract_per_annum']; //41 
 $Contractual_hires_charges = preg_replace('/[^0-9. -]/', '', $_POST['Contractual_hires_charges']); //
 
   //echo "Contractual_hires_charges".$Contractual_hires_charges;
   
   /***********secion 2 newly added fields *****/ 
 $Contractual_Consult_Hire_Per_Year = $_POST['Contractual_Consult_Hire_Per_Year'];
 $Avg_Cost_Consult_Per_Annum = $_POST['Avg_Cost_Consult_Per_Annum'];
 $Contractual_Avg_Recru_Charges = preg_replace('/[^0-9. -]/', '', $_POST['Contractual_Avg_Recru_Charges']);
  //echo "Contractual_Avg_Recru_Charges".$Contractual_Avg_Recru_Charges;
 $Part_Time_Hire_For_Year = $_POST['Part_Time_Hire_For_Year'];
 $Avg_Cost_PartTime_Emp_Per_Annum = $_POST['Avg_Cost_PartTime_Emp_Per_Annum'];
 $Avg_Recru_Charges = preg_replace('/[^0-9. -]/', '', $_POST['Avg_Recru_Charges']);
 
 // echo "Avg_Recru_Charges".$Avg_Recru_Charges;
 /***********secion 2 newly added fields ends *****/
 
 
 /***********secion 3 starts *****/
 $planned_Re_assignment = $_POST['planned_Re_assignment'];
 $Severence_period = $_POST['Severence_period'];
 $employee_reporting_currency = $_POST['employee_reporting_currency'];
 $Approximate_effort = $_POST['Approximate_effort'];
 $Approximate_per_man = $_POST['Approximate_per_man'];
 $cost_external_consulting = $_POST['cost_external_consulting'];
 $cost_brand_erosion = $_POST['cost_brand_erosion'];
 $Legal_external_consulting = $_POST['Legal_external_consulting'];
 
 
 //echo "Legal_external_consulting".$Legal_external_consulting;
 
 /***********secion 3 ends *****/
 
 /***********secion 4 starts *****/
 $planned_Reassignment = $_POST['planned_Reassignment'];
 $Average_overheads = $_POST['Average_overheads'];
 $benched_employee = $_POST['benched_employee'];
 $Number_Under_utilised_employee = $_POST['Number_Under_utilised_employee'];
 $Average_utilisation_age =  preg_replace('/[^0-9. -]/', '', $_POST['Average_utilisation_age']);
     //echo "Average_utilisation_age".$Average_utilisation_age;
 $Under_utilised_employees = $_POST['Under_utilised_employees'];
 $desired_employee =  preg_replace('/[^0-9. -]/', '',$_POST['desired_employee']);
 
  //echo "desired_employee".$desired_employee;
 
 /***********secion 4 ends *****/
 
  /***********secion 4 ends *****/
 
 $planned_Re_assignment_Profits = $_POST['planned_Re_assignment_Profits'];
 
/****6. point  *****/

 $Current_Cost_Of_All_Above_Per_Annum = 0;//$_POST['Current_Cost_Of_All_Above_Per_Annum'];
  
//echo "Current_Cost_Of_All_Above_Per_Annum:".$Current_Cost_Of_All_Above_Per_Annum;
 /*********Summary Information*************/
 
 

 $Savings_Full_Time_Hire = $_POST['Planned_Recru_Third_Party_Zero_Five'] * $_POST['Avg_CTC_Hire_PerAnnum_Zero_Five'] * $Avg_Recru_Charges_Third_Party_PerHire_Zero_Five/100 + $_POST['Planned_Recru_Third_Party_Five_Tweleve'] * $_POST['Avg_CTC_Hire_PerAnnum_Five_Tweleve'] * $Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve/100 + $_POST['Planned_Recru_Third_Party_Tweleve_Eighteen'] * $_POST['Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen'] * $Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen/100  + $_POST['Planned_Recru_Third_Party_Eighteen_More'] * $_POST['Avg_CTC_Hire_PerAnnum_Eighteen_More'] * $Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More/100 + $_POST['Planned_Recru_Emp_Referral_Zero_Five'] * $_POST['Avg_Reff_Fees_To_Emp_Zero_Five'] + $_POST['Planned_Recru_Emp_Referral_Five_Tweleve'] * $_POST['Avg_Reff_Fees_To_Emp_Five_Tweleve'] +  $_POST['Planned_Recru_Emp_Referral_Tweleve_Eighteen'] * $_POST['Avg_Reff_Fees_To_Emp_Tweleve_Eighteen'] + $_POST['Planned_Recru_Emp_Referral_Eighteen_More'] * $_POST['Avg_Reff_Fees_To_Emp_Eighteen_More'];
 
 
 //echo "Savings_Full_Time_Hire".$Savings_Full_Time_Hire;
  $Savings_Full_Time_Hire = $Savings_Full_Time_Hire;
	//echo "Savings_Full_Time_Hire ".$Savings_Full_Time_Hire;
  
  //by Ratnakar old value
 //$Savings_Contract_Consulting_PartTIme_val =(($_POST['Contractual_hires']*$_POST['contract_per_annum'])+($_POST['Consult_Hire_Per_Year']*$_POST['Avg_Cost_Consult_Per_Annum'])+($_POST['Part_Time_Hire_For_Year']*$_POST['Avg_Cost_PartTime_Emp_Per_Annum']));
 //$Savings_Contract_Consulting_PartTIme = $Savings_Contract_Consulting_PartTIme_val*($_POST['Contractual_hires_charges']/100);
  //=(C40*C41+C44*C45+C48*C49)*C42  $_POST['Contractual_hires_charges']
 
// echo "Savings_Contract_Consulting_PartTIme".$Savings_Contract_Consulting_PartTIme;

 //by Ratnakar new value
$Savings_Contract_Consulting_PartTIme_val = $_POST['Contractual_hires'] * $_POST['contract_per_annum'] * $Contractual_hires_charges/100 + $_POST['Consult_Hire_Per_Year'] * $_POST['Avg_Cost_Consult_Per_Annum'] * $Contractual_Avg_Recru_Charges/100 + $_POST['Part_Time_Hire_For_Year'] * $_POST['Avg_Cost_PartTime_Emp_Per_Annum'] * $Avg_Recru_Charges/100;
	
	
 $Savings_Contract_Consulting_PartTIme = $Savings_Contract_Consulting_PartTIme_val;
	//echo "Savings_Contract_Consulting_PartTIme".$Savings_Contract_Consulting_PartTIme;
  
 //by Ratnakar old value
 //$Savings_Reassignmetn_Retrenchment = ($_POST['planned_Re_assignment']*$_POST['employee_reporting_currency']*$_POST['Severence_period']/12+$_POST['Approximate_effort']*$_POST['Approximate_per_man']+$_POST['cost_external_consulting']+$_POST['cost_brand_erosion']);
 
 //by Ratnakar new value
  $Savings_Reassignmetn_Retrenchment = ($_POST['planned_Re_assignment']*$_POST['employee_reporting_currency']*$_POST['Severence_period']/12+$_POST['Approximate_effort']*$_POST['Approximate_per_man']+$_POST['cost_external_consulting']+$_POST['cost_brand_erosion'] +$_POST['Legal_external_consulting']);
 
 //by Ratnakar old value
 // Revenue from placement of bench/ under-utilised resource through collaboration
// $Revenue_Placement_Of_Bench = ($_POST['Avg_Annual_Bench'] *$_POST['benched_employee'] +$_POST['Number_Under_utilised_employee']*$_POST['Under_utilised_employees']*$Average_utilisation_age/100)*(1+$desired_employee/100);
 
 
 //by Ratnakar new value
 $Revenue_Placement_Of_Bench = ($_POST['Avg_Annual_Bench'] *( $_POST['Average_overheads'] + $_POST['benched_employee'])+$_POST['Number_Under_utilised_employee']* (1-$_POST['Average_utilisation_age'] / 100)*($_POST['Under_utilised_employees'] + $_POST['Average_overheads'] ))*(1+$_POST['desired_employee'] / 100);
 
//echo "Revenue_Placement_Of_Bench".$Revenue_Placement_Of_Bench;
 
 $Total_Value = $Savings_Full_Time_Hire + $Savings_Contract_Consulting_PartTIme + $Savings_Reassignmetn_Retrenchment + $Revenue_Placement_Of_Bench;
 
 //echo "Total_Value".$Total_Value;
 
 if( $planned_Re_assignment_Profits==0 ){ 
 $Net_Profit_Percentage = 'NA';}
 else { $Net_Profit_Percentage =$Total_Value/$planned_Re_assignment_Profits;
  $Net_Profit_Percentage =$Net_Profit_Percentage *100;
  $Net_Profit_Percentage = round($Net_Profit_Percentage,2); 
 }
 
 	//number formatting of prices
	$Savings_Full_Time_Hire = number_format("$Savings_Full_Time_Hire");
	$Savings_Contract_Consulting_PartTIme = number_format("$Savings_Contract_Consulting_PartTIme");
	$Savings_Reassignmetn_Retrenchment = number_format("$Savings_Reassignmetn_Retrenchment");
	$Revenue_Placement_Of_Bench = number_format("$Revenue_Placement_Of_Bench"); 
	$Total_Value = number_format("$Total_Value"); 	 
	//ends number formatting here

 //echo "Net_Profit_Percentage".$Net_Profit_Percentage;


 $query="INSERT INTO `detailed_cva`(`id`, `company_name`, `industry`, `email`, `Name`, `Designation`, `Phone`, 
 `Savings_Full_Time_Hire`,
 `Savings_Contract_Consulting_PartTIme`, `Savings_Reassignmetn_Retrenchment`, `Revenue_Placement_Of_Bench`, `Total_Value`, `Net_Profit_Percentage`)
 VALUES ( NUll,'$company_name', '$industry', '$email','$Name', '$Designation', '$Phone',   
 '$Savings_Full_Time_Hire', 
'$Savings_Contract_Consulting_PartTIme', '$Savings_Reassignmetn_Retrenchment', '$Revenue_Placement_Of_Bench', '$Total_Value',  '$Net_Profit_Percentage')";

if ($conn->query($query) === TRUE) {
	 $last_id = $conn->insert_id;
	$_SESSION['last'] = $last_id;
	
  header("Location: https://skillbeyondboundaries.com/collaboration-value-potential-of-sbb-detailed-cva/?success=oks");  

}else{
	//echo "Not Successfully Submitted";
   header("Location: https://skillbeyondboundaries.com/detailedcva/");  
	
}
 
 
 
  
 
}
?>