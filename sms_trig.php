<?php //FILE: index.php 
include 'sms_api.php'; 
$number = '+265993030442'; 
$message = 'from the API'; 
$sms_api_result = sendSMS($number, $message);
// Check if SMS was sent. The $sms_api_result boolean indicates whether the API call was successful.
// You can replace the code below with custom handling logic
if ($sms_api_result[0] == 'OK') { 
// Ok, SMS received by the API 
        echo 'The SMS was sent.'; 
} 
else { 
// Failure, SMS was not sent 
// In this example we display the response to identify the error 
        print_r($sms_api_result); 
} 
?>
