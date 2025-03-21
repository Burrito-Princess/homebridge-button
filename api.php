<?php
if (isset($_GET["api"])) {
    if ($_GET["api"]) {
        $status = array(
            "online" => true,
            "state" => false
        );
        try {
            include "toggleButton.php";
            $status["state"] = $startState;
            echo json_encode($status);
        } 
        
        catch(Exception $e) {
            echo 'Message: ' .$e->getMessage();
        }
        
        
        
    }
}
?>