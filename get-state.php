<?php

// function GetState($uniqueId){


$apiUrl = 'http://localhost.net:8581/api/accessories/' . $uniqueId;
$authToken = $auth; // Replace with your actual token

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
    $fullResponse = json_decode($response);
    // echo "<pre>"; print_r($fullResponse);
    json_decode($response, true);
    
    // echo "<br>";
    $startState = json_decode($response, true)["values"]["On"];
    // echo "startState ".  $startState . "<br>";

}
// }

?>