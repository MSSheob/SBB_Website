<?php
include 'config.php';


if(isset($_POST['submit'])){
	
	
 $company_name = $_POST['company_name'];
 $industry = $_POST['industry'];
 $email = $_POST['email'];
$Name = $_POST['Name'];
 $Designation = $_POST['Designation'];
 $Phone = $_POST['Phone'];
 
 
 echo $Phone;
 
 $Planned_Recru_Third_Party_Zero_Five = $_POST['Planned_Recru_Third_Party_Zero_Five'];
 $Planned_Recru_Third_Party_Five_Tweleve = $_POST['Planned_Recru_Third_Party_Five_Tweleve'];
 $Planned_Recru_Third_Party_Tweleve_Eighteen  = $_POST['Planned_Recru_Third_Party_Tweleve_Eighteen'];
 $Planned_Recru_Third_Party_Eighteen_More= $_POST['Planned_Recru_Third_Party_Eighteen_More'];
 
 
 
 $Planned_Recru_Emp_Referral_Zero_Five = $_POST['Planned_Recru_Emp_Referral_Zero_Five'];
 $Planned_Recru_Emp_Referral_Five_Tweleve = $_POST['Planned_Recru_Emp_Referral_Five_Tweleve'];
 $Planned_Recru_Emp_Referral_Tweleve_Eighteen = $_POST['Planned_Recru_Emp_Referral_Tweleve_Eighteen'];
 $Planned_Recru_Emp_Referral_Eighteen_More = $_POST['Planned_Recru_Emp_Referral_Eighteen_More'];

   
 $Avg_CTC_Hire_PerAnnum_Zero_Five = $_POST['Avg_CTC_Hire_PerAnnum_Zero_Five'];
 $Avg_CTC_Hire_PerAnnum_Five_Tweleve = $_POST['Avg_CTC_Hire_PerAnnum_Five_Tweleve'];
 $Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen = $_POST['Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen'];
 $Avg_CTC_Hire_PerAnnum_Eighteen_More = $_POST['Avg_CTC_Hire_PerAnnum_Eighteen_More'];
 
 
 
 $Avg_Recru_Charges_Third_Party_PerHire_Zero_Five = $_POST['Avg_Recru_Charges_Third_Party_PerHire_Zero_Five'];
 $Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve = $_POST['Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve'];
 $Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen = $_POST['Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen'];
 $Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More = $_POST['Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More'];
 

  $Avg_Reff_Fees_To_Emp_Zero_Five = $_POST['Avg_Reff_Fees_To_Emp_Zero_Five'];
 $Avg_Reff_Fees_To_Emp_Five_Tweleve = $_POST['Avg_Reff_Fees_To_Emp_Five_Tweleve'];
 $Avg_Reff_Fees_To_Emp_Tweleve_Eighteen = $_POST['Avg_Reff_Fees_To_Emp_Tweleve_Eighteen'];
 $Avg_Reff_Fees_To_Emp_Eighteen_More = $_POST['Avg_Reff_Fees_To_Emp_Eighteen_More'];
 
// echo "Avg_Reff_Fees_To_Emp_Eighteen_More".$Avg_Reff_Fees_To_Emp_Eighteen_More;
 
  $Contractual_hires = $_POST['Contractual_hires'];  //40
 $contract_per_annum = $_POST['contract_per_annum']; //41 
 $Contractual_hires_charges = $_POST['Contractual_hires_charges']; //
 
   ///echo "Contractual_hires_charges".$Contractual_hires_charges;
   
   /***********secion 2 newly added fields *****/ 
 $Contractual_Consult_Hire_Per_Year = $_POST['Contractual_Consult_Hire_Per_Year'];
 $Avg_Cost_Consult_Per_Annum = $_POST['Avg_Cost_Consult_Per_Annum'];
 $Contractual_Avg_Recru_Charges = $_POST['Contractual_Avg_Recru_Charges'];
 $Part_Time_Hire_For_Year = $_POST['Part_Time_Hire_For_Year'];
 $Avg_Cost_PartTime_Emp_Per_Annum = $_POST['Avg_Cost_PartTime_Emp_Per_Annum'];
 $Avg_Recru_Charges = $_POST['Avg_Recru_Charges'];
 
  //echo "Avg_Recru_Charges".$Avg_Recru_Charges;
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
 
 /*********Summary Information*************/
 
 

 $Savings_Full_Time_Hire = $_POST['Planned_Recru_Third_Party_Zero_Five'] *$_POST['Avg_CTC_Hire_PerAnnum_Zero_Five'] * $_POST['Avg_Recru_Charges_Third_Party_PerHire_Zero_Five'] + $_POST['Planned_Recru_Third_Party_Five_Tweleve'] * $_POST['Avg_CTC_Hire_PerAnnum_Five_Tweleve'] * $_POST['Avg_Recru_Charges_Third_Party_PerHire_Five_Tweleve'] + $_POST['Planned_Recru_Third_Party_Tweleve_Eighteen']*$_POST['Avg_CTC_Hire_PerAnnum_Tweleve_Eighteen'] * $_POST['Avg_Recru_Charges_Third_Party_PerHire_Tweleve_Eighteen']  +$_POST['Planned_Recru_Third_Party_Eighteen_More'] * $_POST['Avg_CTC_Hire_PerAnnum_Eighteen_More'] * $_POST['Avg_Recru_Charges_Third_Party_PerHire_Eighteen_More'];
 

  $Savings_Full_Time_Hire = $Savings_Full_Time_Hire /100;
  
  echo "Savings_Full_Time_Hire  ".$Savings_Full_Time_Hire;
 
  $Savings_Contract_Consulting_PartTIme_part1 = $_POST['Contractual_hires']*$_POST['contract_per_annum'];
 $Savings_Contract_Consulting_PartTIme_part2 = $_POST['Consult_Hire_Per_Year']*$_POST['Avg_Cost_Consult_Per_Annum'];
 $Savings_Contract_Consulting_PartTIme_part3 = $_POST['Part_Time_Hire_For_Year']*$_POST['Avg_Cost_PartTime_Emp_Per_Annum'];
 
 
   echo "Savings_Contract_Consulting_PartTIme_part1  ".$Savings_Contract_Consulting_PartTIme_part1;
 
   echo "Savings_Contract_Consulting_PartTIme_part2  ".$Savings_Contract_Consulting_PartTIme_part2;
 
 
   echo "Savings_Contract_Consulting_PartTIme_part3  ".$Savings_Contract_Consulting_PartTIme_part3;
 
    $Savings_Contract_Consulting_PartTIme_part4  = $_POST['Contractual_hires_charges']/100;
  
   
    //  echo "Savings_Contract_Consulting_PartTIme_part4  ".$Savings_Contract_Consulting_PartTIme_part4;
	   
	  $Savings_Contract_Consulting_PartTIme = ($Savings_Contract_Consulting_PartTIme_part1+$Savings_Contract_Consulting_PartTIme_part2+$Savings_Contract_Consulting_PartTIme_part3)*     $Savings_Contract_Consulting_PartTIme_part4 ;
	  
	  echo "Savings_Contract_Consulting_PartTIme".$Savings_Contract_Consulting_PartTIme;
  
  
 $Savings_Reassignmetn_Retrenchment = ($_POST['planned_Re_assignment']*$_POST['employee_reporting_currency']*$_POST['Severence_period']/12+$_POST['Approximate_effort']*$_POST['Approximate_per_man']+$_POST['cost_external_consulting']+$_POST['cost_brand_erosion']);
 
  echo "Savings_Reassignmetn_Retrenchment".$Savings_Reassignmetn_Retrenchment;
  
  $One = 1;
     /*//
    $Revenue_Placement_Of_Bench_Part1 =$_POST['Avg_Annual_Bench'] *$_POST['benched_employee'] ;
    $Revenue_Placement_Of_Bench_Part2 =$_POST['Number_Under_utilised_employee']*$_POST['Under_utilised_employees']*$_POST['Average_utilisation_age'] ;
    $Revenue_Placement_Of_Bench_Part3 = $One+$_POST['desired_employee'];
	
	echo "Revenue_Placement_Of_Bench_Part1 ".$Revenue_Placement_Of_Bench_Part1;
  
  echo "Revenue_Placement_Of_Bench_Part2 ".$Revenue_Placement_Of_Bench_Part2;
  
  echo "Revenue_Placement_Of_Bench_Part3".$Revenue_Placement_Of_Bench_Part3;
  
	 
 $Revenue_Placement_Of_Bench = ($_POST['Avg_Annual_Bench'] *$_POST['benched_employee'] +$_POST['Number_Under_utilised_employee']*$_POST['Under_utilised_employees']*$_POST['Average_utilisation_age'])
 *($One+$_POST['desired_employee']);
 
 echo "Revenue_Placement_Of_Bench".$Revenue_Placement_Of_Bench;



(Avg_Annual_Bench*benched_employee+Number_Under_utilised_employee*Under_utilised_employees*Average_utilisation_age)*(1+desired_employee)
  
  

 $Savings_Contract_Consulting_PartTIme_val =$_POST['Contractual_hires']*$_POST['contract_per_annum']+ $_POST['Consult_Hire_Per_Year']*$_POST['Avg_Cost_Consult_Per_Annum']+ $_POST['Part_Time_Hire_For_Year']*$_POST['Avg_Cost_PartTime_Emp_Per_Annum'];
 */
  //*$_POST['Contractual_hires_charges']/100
  //echo "Savings_Contract_Consulting_PartTIme_val  ".$Savings_Contract_Consulting_PartTIme_val*5/100;
 

 
 
}
?>