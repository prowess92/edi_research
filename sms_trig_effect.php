<?php 
//php script for sending sms with side effects notifications
include 'sms_api.php'; 


	$number = array('0993030442', '0999814793', '0999952622', '0888149994', '0999771333', '0999933910', '0993030434', '0996234931', '0999758400');        
	
	$count = count($number);
	 
	for($i=0;$i<$count;$i++){
	print_r($number[$i]);
	echo "\n";	

	$current_number = $number[$i]; 
	//for daily sms reminders change value of $message_effect1 and $message_effect2 variable
	$message_effect1 = "Mukumbukire kuti zizindikiro zosonyeza kuti mwadana ndi makhwala, ndi chikasu m'maso, zilonda pa khungu ndi dzanzi m'manja ndi mmiyendo";

	$message_effect2 = "Mukumbukire kuti zizindikiro za makhwala zosaopsya ndi chizungulire, maloto achilendo ndi nselu";
       
	$sms_api_result = sendSMS($current_number, $message_effect1);
	print_r($sms_api_result);

	// Check if SMS was sent. The $sms_api_result boolean indicates whether the API call was successful.
	// You can replace the code below with custom handling logic
	$sms_api_result = sendSMS($current_number, $message_effect2);

	// Check if SMS was sent. The $sms_api_result boolean indicates whether the API call was successful.
	// You can replace the code below with custom handling logic
	print_r($sms_api_result); 
	}
	
	
?>
