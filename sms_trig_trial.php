<?php 
include 'sms_api.php'; 


	$number = array('0993030442', '0999814793', '0999952622', '0888149994', '0999771333', '0999933910', '0993030434');        
	
	$number = array('0996234931');
	$count = count($number);
	 
	for($i=0;$i<$count;$i++){
	print_r($number[$i]);
	echo "\n";	

	$current_number = $number[$i]; 
	//for daily sms reminders change value of $message_daily variable
	$message_daily = "Mukukumbitsidwa kuti musayiwale kamwedwe mwadongosolo loyenelera musanagone. Paja ndi limodzi kamodzi.";
       
	$sms_api_result = sendSMS($current_number, $message_daily);
	// Check if SMS was sent. The $sms_api_result boolean indicates whether the API call was successful.
	// You can replace the code below with custom handling logic
	print_r($sms_api_result); 
	}
	
	
?>
