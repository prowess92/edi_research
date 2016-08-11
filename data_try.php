<?php
ini_set('display_errors', 1);

//insert patient IDs to $patient_ids variable

echo "ARV Number\t";
echo "| Phone\t\t";
echo "| Duration\t\t";
echo "\n";
//database connection 
$connect = mysqli_connect('172.25.9.131', 'root', 'root', 'openmrs');
 
$q="SELECT DISTINCT
(SELECT identifier FROM patient_identifier a WHERE a.patient_id = d.person_id 
AND a.identifier_type = 4 AND  a.voided = 0  LIMIT 1) arv_number, 
(SELECT identifier FROM patient_identifier b WHERE b.patient_id = d.person_id 
AND b.identifier_type = 3 AND  b.voided = 0  LIMIT 1) patient_identifier,
d.birthdate,
d.gender,
(SELECT value FROM person_attribute c WHERE c.person_id = d.person_id  
AND c.person_attribute_type_id = 13 AND  c.voided = 0  LIMIT 1) occupation,
(SELECT value FROM person_attribute c WHERE c.person_id = d.person_id  
AND c.person_attribute_type_id = 12 AND  c.voided = 0  LIMIT 1) cellphone_number,
(SELECT date_enrolled FROM patient_program e WHERE e.patient_id = d.person_id AND 
e.program_id = 1 AND e.voided = 0 LIMIT 1) enrollment_date,
(SELECT instructions FROM orders g WHERE g.patient_id = d.person_id AND
 g.voided = 0 ORDER BY g.date_created DESC LIMIT 1) drug_taken,
 (SELECT DATEDIFF(h.auto_expire_date,h.start_date) FROM orders h WHERE h.patient_id = d.person_id AND
 h.voided = 0 ORDER BY h.date_created DESC LIMIT 1) duration,
 (SELECT DATE(i.value_datetime) FROM obs i WHERE i.person_id = d.person_id AND
 i.voided = 0 ORDER BY i.date_created DESC LIMIT 1) next_appointment
FROM person d INNER JOIN patient_program j ON  d.person_id = j.patient_id  
WHERE d.person_id IN 




(-- paste IDs here --)





AND DATE(j.date_enrolled) >= DATE('2016-04-01')
AND DATEDIFF(now(),d.birthdate)/365 > 18";
$r=mysqli_query($connect,$q);

$edi = new mysqli('localhost', 'root', 'root', 'edi');

while ($s=mysqli_fetch_array($r)){
	$arv_number = $s['arv_number'];
	$patient_identifier = $s['patient_identifier'];
	$dob = $s['birthdate'];
	$gender = $s['gender'];

	if ($gender=='M'){
		$gender='Male';	
	}elseif ($gender=='F'){
		$gender='Female';
	}

	$occupation = $s['occupation'];
	$phone = $s['cellphone_number'];
	$enrollment_date = $s['enrollment_date'];
	$drug_taken = $s['drug_taken'];
	$duration = $s['duration'];
	$next_appointment = $s['next_appointment']; 

	if (is_numeric($phone)){
		if($phone != 'Unknown' && $phone != 'N/A' && $phone != 'none' && $phone != 'NULL' && $phone != 'null' && $phone != ' '){
			$new_client  = "INSERT INTO clients (arv_number,patient_identifier,dob,gender,occupation,phone,created_at,updated_at) VALUES ('$arv_number','$patient_identifier','$dob','$gender','$occupation','$phone', now(), now())";
        
			$edi->query($new_client);        

			$new_client_id = $edi->insert_id;  

			$client_medicals =  "INSERT INTO client_medicals (client_id,regimen,enrollment_date,created_at,updated_at) VALUES ('$new_client_id','$drug_taken','$enrollment_date', now(), now())";

			$edi->query($client_medicals);        

			$appointments =  "INSERT INTO appointments	(client_id,due_date,duration,created_by,created_at,updated_at) VALUES ('$new_client_id',DATE('$next_appointment'), '$duration', 'Edith Kumwenda', now(), now())";

			$edi->query($appointments); 

			$new_appointment_id = $edi->insert_id;        


			echo $arv_number."\t";
			echo "| ".$phone."\t";
			echo "| ".$duration."\t";
			echo "\n";
		}
	}
}
?>
