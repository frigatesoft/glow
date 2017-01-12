<?php
 //localhost:8080/Autizam/getuserfinishedlevels.php?userid=1&stage=1
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
 //&& isset($_POST['id']) && isset($_POST['practice'])

    // receiving the post params
    $userId = $_REQUEST["userid"];
    $StageID = $_REQUEST['stage'];
    
    // check if user is already existed with the same email
    if ($db->isUserIDExisted($userId) === false) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User Not Exists " . $userId;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->getUserFinishedLevels($userId,$StageID);
        if ($user) {
            // user stored successfully
            //$response["error"] = FALSE;
            $response["error_msg"] = $user;
            
            echo json_encode($response);
        } else {
            // user failed to store
            //$response["error"] = TRUE;
            $response["error_msg"] = "Error getting from db.";
            echo json_encode($response);
        }
    }
?>