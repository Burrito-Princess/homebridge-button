<?php

use WpOrg\Requests\Response;

session_start();
header("Access-Control-Allow-Origin: *");
// Database is to slow sometimes, so it checks on Session first.
if (isset($_SESSION["rate"])){
    
    if (time() >= $_SESSION["rate"] + 5){
        echo api();
        $_SESSION["rate"] = time();
    } else {
        // Error response if the last request (in the session) was less then 5 seconds ago.
        echo json_encode(array("response" => false, "message" => "Hold up there partner, You've been ratelimited"));
    }
} else {
    // First time calling api, session is not set, so it gets a call without session check.
    $_SESSION["rate"] = time();
        echo api();
        $_SESSION["rate"] = time();
}

function api(){

    include "creds.php";
    try {
        $givenApiKey = $_GET["key"];
        $conn = new PDO("mysql:host=$hostDB;dbname=$dbname", $userDB, $passwordDB);
        $stmt = $conn->prepare("SELECT * FROM overall WHERE apiKey = :apiKey");
        $stmt->execute(['apiKey' => $givenApiKey]);
        $response = $stmt->fetch(PDO::FETCH_ASSOC);   
    } catch (PDOException $e){
        // return json_encode(array("response" => false, "message" => "Wow there partner, it seems something went wrong. Perhaps check your API key", "errorMessage" => $e->getMessage()));
        exit;
    }
    // checks the given apikey, if it exists it conintues, else it errors and quits.
       

    if ($_GET["key"] == $response["apiKey"]) {
        $status = array(
            "response" => true,
            "state" => false,
            "device" => false
        );
        // if the api key is correct, check current time agaist last database entry.
        if (time() >= $response["timestamp"] + 5) {
            if (isset($_GET["deviceName"]) && $response["fullAccess"] == 1){
                $deviceName = $_GET["deviceName"];
            } else if (!isset($_GET["deviceName"])){
                $deviceName = "Desk lights";
            } else {
                return json_encode(array("reponse" => false, "message" => "get outta here, insufficient permission Lag"));

            }
            // last entry more then 5 seconds ago, set status, enter new time, toggle lamp, return status.
                        
                    try {
                        include "toggle.php";
                        $deviceName = $_GET["deviceName"];
                        $startState = toggleFunc($deviceName);
                        $status["state"] = $startState;
                        $status["device"] = $deviceName;
                        $time = time();
                        $stmt = $conn->prepare("UPDATE overall SET `timestamp` = :time WHERE apiKey = :apiKey");
                        $stmt->execute([
                            'apiKey' => $_GET["key"], 
                            'time' => $time
                        ]);
                        // $stmt->execute();
                        return json_encode($status);
                    } catch (Exception $e) {
                        // echo 'Message: ' . $e->getMessage();
                    }
        } else {
            // If enntry in database is less then 5 seconds ago, it sends a false response with message.
            return json_encode(array("response" => false, "message" => "Hold up there partner, You've been ratelimited"));
        }
    } else {
        // If key is incorrect, return false response with message.
        return json_encode(array("response" => false, "message" => "Wow there partner, that key is mighty incorrect"));
    }
}