<?php
include "./creds.php";
include "./login.php";
include "./get-accessories.php";
include "./toggle.php";
include "./get-state.php";
if ($startState == 0) {
    toggle(json_encode(['characteristicType' => 'On', 'value' => true]), $uniqueId, $auth);
    sleep(1);
    toggle(json_encode(['characteristicType' => 'On', 'value' => false]), $uniqueId, $auth);

} else {
    toggle(json_encode(['characteristicType' => 'On', 'value' => false]), $uniqueId, $auth);
    sleep(1);
    toggle(json_encode(['characteristicType' => 'On', 'value' => true]), $uniqueId, $auth);

}?>