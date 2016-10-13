<?php
ini_set('display_errors', 1);


$edi = mysqli_connect('localhost', 'root', 'root', 'edi');

$patient_identifier = "SELECT patient_identifier FROM clients ORDER BY arv_number";
$query = mysqli_query($edi,$patient_identifier);
while($z=mysqli_fetch_array($query)){
	$patient_identifier = $z['patient_identifier'];
	echo '"'.$patient_identifier.'",&nbsp;';
}
?>
