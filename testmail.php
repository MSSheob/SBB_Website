<?php
$to = "ts_support@sbts.in";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: anilkumar@sbts.in";

$mail=mail($to,$subject,$txt,$headers);
if($mail){
echo "mail sent success";
}
else{
echo "mail not sent";
}
?>