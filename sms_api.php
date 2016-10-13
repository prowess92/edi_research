<?php //FILE: sms_api.php 
ini_set('display_errors', 1);
function sendSMS($number, $message) { 
        $url = "https://cloud.frontlinesms.com/api/1/webhook"; /* Set your frontlinesms or frontlinecloud webconnection url here*/
        //$secret = "468f086e-d746-4ddf-be37-bdc2dae0be2e"; //Set the secret here skumwenda email mph_connection4 8thOct
//$secret = "c7e52617-5385-4e4c-bec7-2f3c5dfb01a7"; //Chimtengo email mph_connection5 9thOct chimtengo@1
        $secret = "d5d27b7a-718b-465b-aa7c-1b842a3b60f2"; //wemi.kumwenda email mph_connection6 12thOct edithg84
        //$secret = "99be761d-30b5-46d6-b820-205534160628"; //Set the secret here mwai email
        //$secret = "f892aa73-3021-437c-9087-fa15423f96ad"; //Set the secret here edith.kumwenda email

        //$secret = "5f5bbb0a-7390-47fe-b51e-ecd633170cc1"; // Set the secret here egulule email.com


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


