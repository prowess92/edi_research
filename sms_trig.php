<?php
ini_set('display_errors', 1);
//php script for sending sms reminders to all patients (including appointment reminders)  
include 'sms_api.php'; 

$edi = new mysqli('localhost', 'root', 'root', 'edi');
$q = "SELECT `id`, `phone` FROM clients WHERE phone != 'unknown' AND phone != 'N/A' AND phone != 'none' AND phone IS NOT NULL AND consent = 1";
$r=mysqli_query($edi,$q);

while ($s=mysqli_fetch_array($r)){
	$current_id = $s['id'];
	$current_number = $s['phone'];
	
	
	//for daily sms reminders change value of $message_daily variable
	$message_daily = 'Mukukumbitsidwa kuti musayiwale kamwedwe ka mankhwala leroli musanagone. Komanso mukumbukile ndondomeko yakamwedwe. Zikomo';
	
        
 
	$sms_api_result = sendSMS($current_number, $message_daily);
	print_r($sms_api_result); 

	//for apology smsduring downtimes
	$message_apology = 'Pepani chifukwa chosakutumizilani chikumbutso cha kamwedwe ka mankhwala masiku apitawa kamba ka zovuta zina';
	
        
 
	$sms_api_result = sendSMS($current_number, $message_apology);
	print_r($sms_api_result); 

	
	$appoint = "SELECT `due_date`, `duration`, (DATEDIFF(due_date, now())) days_now FROM appointments WHERE `client_id` = '$current_id'  ORDER BY `created_at` DESC LIMIT 1 ";
	$query=mysqli_query($edi,$appoint);
	$next_appoint= mysqli_fetch_array($query);
	
	if ($next_appoint['days_now']>'0' && $next_appoint['days_now']<='4'){

		$due_date = $next_appoint['due_date'];
		$due_date = new DateTime($due_date);
		$due_date = $due_date->format('d M Y');	
		
	
		//for appointment sms reminders change value of $message_appointment variable
		$message_appointment = "Mukumbukire kuti mukuyenera kubweranso ku chipatala pa ".$due_date;		
		
		$sms_api_result = sendSMS($current_number, $message_appointment);
		echo $current_number."\n";
                 print_r($sms_api_result); 
	}
} 
?>
