<?php 
//php script for sending sms with side effects notifications
include 'sms_api.php'; 


	$number = array('0888722434');        
	
	$count = count($number);
	 
	for($i=0;$i<$count;$i++){
	print_r($number[$i]);
	echo "\n";	

	$current_number = $number[$i]; 
	//for daily sms reminders change value of $message_effect1 and $message_effect2 variable
	$message_effect1 = "Mukumbukire kuti zizindikiro zosonyeza kuti mwadana ndi makhwala, ndi chikasu m'maso, zilonda pa khungu ndi dzanzi m'manja ndi mmiyendo";

	$message_effect2 = "Mukumbukire kuti zizindikiro za makhwala zosaopsya ndi:- Chizungulire, Maloto a chilendo ndi Nselu, ndipo zimenezi zimasiya zokha";
       
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
