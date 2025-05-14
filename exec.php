<?php
include "login.php";
// toggle(json_encode(['characteristicType' => 'On', 'value' => false]), '3bbd148fccac83bbfb332c9726373cc6c6959d3f3ae0af2c309c4065487bc4bb', $auth);
function toggle ($data, $uniqueId, $auth){
    include "./creds.php";
    $apiUrl = 'http://' . $host . ':8581/api/accessories/' . $uniqueId;
    $authToken = $auth;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: */*',
        'Authorization: Bearer ' . $authToken,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    $response = curl_exec($ch);
    
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    } else {
        // echo "<pre>"; print_r(json_decode($response));
    }
    
    curl_close($ch);
}



?>