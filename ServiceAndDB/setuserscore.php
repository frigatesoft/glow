<?php
 //localhost:8080/Autizam/setuserscore.php?id=23&practice=34&score=3&timeing=3.4
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
 //&& isset($_POST['id']) && isset($_POST['practice'])

    // receiving the post params
    $userId = $_REQUEST["id"];
    $practiceID = $_REQUEST['practice'];
    $userScore = $_REQUEST['score'];
    $userTiming = $_REQUEST['timing'];
    $Stage = $_REQUEST['stage'];
   
    // check if user is already existed with the same email
    if ($db->isUserIDExisted($userId) === false) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User Not Exists " . $userId;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->SetUserScore($userId, $practiceID, $userScore,$userTiming,$Stage);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["error_msg"] = "saved successfully.";
            
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Error Saving on DB.";
            echo json_encode($response);
        }
    }
?>