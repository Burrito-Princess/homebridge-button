<?php

$apiUrl = 'http://' . $host . ':8581/api/accessories/layout';
$authToken = $auth;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: */*',
    'Authorization: Bearer ' . $authToken
]);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $array = json_decode($response, true);
    $response = json_decode($response);
    // echo "<pre>"; print_r($response);
    // echo gettype($array);
    foreach ($array[0]["services"] as $device){
        
        if (isset($device["customName"])){
            // echo $device["customName"] . "<br>";
            if ($device["customName"] == "Desk lights"){
                $uniqueId = $device["uniqueId"];
                break;
            }
        } else {

        }
    }
}
curl_close($ch);

?>