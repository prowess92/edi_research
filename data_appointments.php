<?php
ini_set('display_errors', 1);

//insert patient IDs to $patient_ids variable

echo "Patient Identifier\t";
echo "| Next Appointment\t\t";
echo "\n";


//database connection laptop
$connect = mysqli_connect('172.25.9.131', 'root', 'root', 'openmrs');
$edi = mysqli_connect('localhost', 'root', 'root', 'edi');

$del_app = "DELETE FROM `appointments`";
mysqli_query($edi,$del_app);

$patient_identifier = "SELECT id, patient_identifier FROM clients";
$query = mysqli_query($edi,$patient_identifier);
while($z=mysqli_fetch_array($query)){
	$patient_identifier = $z['patient_identifier'];
	$client_id = $z['id'];
		
	
 	//echo $arv_number; 
	$patient = "SELECT patient_id FROM patient_identifier  WHERE identifier = '$patient_identifier' AND  
	voided = 0"; 	
	$query2 = mysqli_query($connect,$patient);
	while($p=mysqli_fetch_array($query2)){
		$patient_id = $p['patient_id'];	

		$q="SELECT DISTINCT value_datetime FROM obs 
		   WHERE person_id = '$patient_id' AND  voided = 0 ORDER BY date_created DESC LIMIT 1";
		$r=mysqli_query($connect,$q);

		while ($s=mysqli_fetch_array($r)){
			
	
			$next_appointment = $s['value_datetime']; 

			$appointments =  "INSERT INTO appointments (client_id,due_date,created_by,created_at,updated_at) VALUES 
			('$client_id',DATE('$next_appointment'), 'Edith Kumwenda', now(), now())";

			$edi->query($appointments); 

			echo $patient_identifier."\t";
			echo "| ".$next_appointment;
			echo "\n";
		}
	}
}
?>
