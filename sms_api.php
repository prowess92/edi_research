<?php //FILE: sms_api.php 
ini_set('display_errors', 1);
function sendSMS($number, $message) { 
        $url = "https://cloud.frontlinesms.com/api/1/webhook"; /* Set your frontlinesms or frontlinecloud webconnection url here*/
        $secret = "f892aa73-3021-437c-9087-fa15423f96ad"; // Set the secret here
        $request = array( 
                        'apiKey' => $secret, 
			'payload' => array(
                        	'message' => $message, 
                       		'recipients' => array(array( 
                                	'type' => 'mobile', 
                                	'value' => $number 
                        )))
                );  
        $req = json_encode($request);
        $ch = curl_init( $url );  
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
        curl_setopt( $ch, CURLOPT_POST, true );  
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );  
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
        $result = curl_exec($ch); 
        curl_close($ch);
        return explode(',',$result); 
}
?>


