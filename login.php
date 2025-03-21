<?php
include "creds.php";
$apiUrl = 'http://' . $host . ':8581/api/auth/login';
$data = [
    "username" => "$user",
    "password" => "$password"
];

$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Accept: */*",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    $auth = json_decode($response, true)["access_token"];
 

}
curl_close($ch);
?>