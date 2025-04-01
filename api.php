<?php
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
    // check if the api key is correct.
    if ($_GET["key"] == $apiKey) {
        // if the api key is correct, check current time agaist last database entry.
        try {
            $conn = new PDO("mysql:host=$hostDB;dbname=$dbname", $userDB, $passwordDB);
            $stmt = $conn->prepare("SELECT timestamp FROM overall");
            $stmt->execute();
            $prevTimestamp = $stmt->fetch(PDO::FETCH_ASSOC)["timestamp"];
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            echo json_encode('[{"name":"error","msg":"' . $e->getMessage() . '"}]');
        };
        if (time() >= $prevTimestamp + 5) {
            // last entry more then 5 seconds ago, set status, enter new time, toggle lamp, return status.
                        $status = array(
                        "response" => true,
                        "state" => false
                    );
                    try {
                        include "toggleButton.php";
                        $startState = toggleFunc();
                        $status["state"] = $startState;
                        $time = time();
                        $stmt = $conn->prepare("UPDATE overall SET `timestamp` = $time");
                        $stmt->execute();
                        return json_encode($status);
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
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