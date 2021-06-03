<?php
// API Request
//Patient is hardcoded category
$url="https://stmarysdentalservices.com/api_dentalapp/Api/request/21232f297a57a5a743894a0e4a801fc3";

// Create a new cURL resource
$ch = curl_init($url);

// Setup request to send json via POST
$data = array(
    'name' => $_POST['client_names'],
    'mobile' => $_POST['phone_no'],
    'email' => $_POST['email'],
    "clinic"=> "St. Marys Dental Clinic",
    "doctor" => '1',
    "address" => 'Via the Website',
    "request_date" =>date('Y-m-d'),
   "requested_date" =>date('Y-m-d',strtotime($_POST['appoint_date'])),
    "services" => $final_services,
   "remarks" => $description,
   "usertype" => "Patient"
    
);

$jsonDataEncoded = json_encode($data);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
$result = curl_exec($ch);
curl_close($ch);


//curl get

$url = 'https://www.stmarysdentalservices.com/api_dentalapp/Api/services/21232f297a57a5a743894a0e4a801fc3';
;
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL, $url);
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
$contents = curl_exec($ch);
if (curl_errno($ch)) {
  echo curl_error($ch);
  echo "\n<br />";
  $contents = '';
} else {
  curl_close($ch);
}

if (!is_string($contents) || !strlen($contents)) {
echo "Failed to get contents.";
$contents = '';
}
$output=json_decode($contents); 
$services=$output->requests;



foreach ($services as $row) { ?>
<option class="btn btn-default btn-sm list-group-item" value="<?php echo $row->name;?>"><?php  echo $i++.'. '. $row->name;?></option>
<?php }
?>
  
</select>		