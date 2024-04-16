<?php
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
 $name_company = $_POST['name_company'];
    $requester_name = $_POST['requester_name'];
    $designation = $_POST['requester_designation'];
    $requester_email = $_POST['requester_email'];
    $requester_phone = $_POST['requester_phone'];
    $best_time_to_contact = $_POST['best_time_to_contact'];	
    $name=$_POST['name'];
    $phone=$_POST['phone'];
     $email= $_POST['email'];
	$token = $_SESSION['token'];
	//echo "Email".$email;
	
	$invitee = array(

                        'name' => $name,
                        'email' => $email,
                        'phone' => $phone

                       );

    $form_data = array(
                      'name_of_org' => $name_company, 
                      'requester_name' => $requester_name,
                      'requester_designation' => $designation,
                      'requester_email' => $requester_email,
                      'best_time_to_contact'=> $best_time_to_contact,
                      'requester_phone' => $requester_phone,
                       'invitee' => $invitee
                  );
	//print_r($form_data);
	
	$data = json_encode($form_data,true);

//echo $data ;

	$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://app.skillbeyondboundaries.com/api/v1/request-membership",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>$data,
  CURLOPT_HTTPHEADER => array(
	  "Authorization:" . $token,
	  "Content-Type: application/json"
    
  ),
));
$response = curl_exec($curl);
$emps = json_decode($response, true);
$output = $emps['message'];
curl_close($curl);
	
	if($output == "email has been sent."){
header("location: https://skillbeyondboundaries.com/request-membership/?true=true&requester_name=".$requester_name);
		
	}else{
		header("location: https://skillbeyondboundaries.com/request-membership/?fail");
	}
	
}

?>