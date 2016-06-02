<?php 
include 'sms_api.php'; 

$edi = new mysqli('localhost', 'root', 'root', 'edi');
$q = "SELECT `id`, `phone` FROM clients WHERE phone != 'unknown' AND phone != 'N/A' AND phone != 'none' ";
$r=mysqli_query($edi,$q);

while ($s=mysqli_fetch_array($r)){
	$current_id = $s['id'];
	//$number = array('0993030442', '0999814793', '0999952622', '0888149994', '0999771333', '0999933910', '0993030434');        
	
	//$count = count($number);
	 
	//for($i=0;$i<$count;$i++){
	//print_r($number[$i]);
	//echo "  ";	

	//$current_number = $s['phone'];
	//$current_number = $number[$i]; 
	//$message_daily = 'Mukukumbitsidwa kuti musayiwale kamwedwe mwadongosolo loyenelera musanagone. Paja ndi limodzi kamodzi.';

	
        
 
	//$sms_api_result = sendSMS($current_number, $message_daily);
	// Check if SMS was sent. The $sms_api_result boolean indicates whether the API call was successful.
	// You can replace the code below with custom handling logic
	//print_r($sms_api_result); 
	//}
	
	$appoint = "SELECT `due_date`, `duration`, (DATEDIFF(due_date, now())) days_now FROM appointments WHERE `client_id` = '$current_id' AND DATEDIFF(due_date, now()) >= 7  ORDER BY `created_at` DESC LIMIT 1 ";
	$query=mysqli_query($edi,$appoint);
	$next_appoint= mysqli_fetch_array($query);
	
	if ($next_appoint['days_now']=='7'){

		$due_date = $next_appoint['due_date'];
		$due_date = new DateTime($due_date);
		$due_date = $due_date->format('d M Y');	
		echo " ";
	
		$message_appointment = 'Mukumbukire kuti mukuyenera kubweranso lachisanu pa '.$due_date.'.';
		echo $message_appointment;
		echo "\n";
		//$sms_api_result = sendSMS($current_number, $message_appointment);
		//print_r($sms_api_result); 
	}
} 
?>
