<?php 
include "./creds.php";
include "./get-accessories.php";
include "./toggle.php";
include "./get-state.php";
if ($startState == 0){
    toggle(json_encode(['characteristicType' => 'On','value' => true]), $uniqueId);
} else {
    toggle(json_encode(['characteristicType' => 'On','value' => false]), $uniqueId);
}?>