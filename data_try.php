<?php
ini_set('display_errors', 1);

//insert patient IDs to $patient_ids variable

//echo $patient_ids;


echo "ARV Number\t";
echo "| Phone\t\t";
echo "| Duration\t\t";
echo "\n";
//database connection 
//$connect = mysqli_connect('172.25.9.131', 'root', 'root', 'openmrs');
 $connect = mysqli_connect('localhost', 'root', 'root', 'openmrs_thyolo');
 
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
 (SELECT DATE(i.auto_expire_date) FROM orders i WHERE i.patient_id = d.person_id AND
 i.voided = 0 ORDER BY i.date_created DESC LIMIT 1) next_appointment
FROM person d INNER JOIN patient_program j ON  d.person_id = j.patient_id  
WHERE d.person_id IN 
(8319,15747,18583,42841,43210,43452,52293,55865,57671,62157,63531,64484,65149,66587,68012,68659,68699,69766,70092,71427,74981,77739,79974,82229,83254,85112,87792,93636,95569,95614,96134,98116,101699,103146,105707,108510,108749,109473,110249,110635,111213,112864,114925,116095,121453,126303,127599,130272,131143,131530,133281,135848,140145,142872,148082,148672,149962,152734,152968,153575,154628,156616,157298,160080,162758,166842,167410,169415,171676,173943,173947,174875,176702,177167,179040,179252,179838,181358,183141,184675,187298,188151,189488,189563,189736,190874,191362,192967,193280,193554,195285,195450,195755,197457,198461,198964,199324,199373,199429,201750,201883,202241,202518,202933,203326,204102,204369,206130,206650,206668,206738,207130,207412,207605,207766,207845,208116,208142,208621,208755,208764,208957,209000,209547,209566,209826,210675,210722,211208,211212,211279,211504,211680,211901,211938,211964,212159,212187,212264,212310,212326,212416,212471,212562,212610,212706,212843,212908,212931,213055,213135,213152,213371,213385,213403,213410,213424,213431,213713,213917,214000,214006,214191,214305,214324,214406,214516,214682,215155,215171,215218,215382,215417,215533,215628,215699,215787,215806,215846,215928,216436,216530,216552,216721,216746,217159,217182,217407,217461,217543,217619,217638,217654,217725,217766,217816,218096,218165,218196,218198,218314,218363,218681,218694,218698,218708,218975,219045,219182,219513,219711,219924,220059,220188,220195,220264,220296,220741,220851,220938,221017,221021,221026,221029,221084,221140,221237,221290,221291,221518,221725,221785,221926,222353,222615,222648,222766,222795,223026,223194,223216) 
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
