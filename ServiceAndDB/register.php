<?php
 //localhost:8080/Autizam/register.php?name=sdf&age=34
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
 //&& isset($_POST['email']) && isset($_POST['password'])

    // receiving the post params
    $name = $_REQUEST["name"];
    $email = $_REQUEST['name'];
    $password ="ddd";//" $_POST['password'];
    $age = $_REQUEST['age'];
   
    // check if user is already existed with the same email
    if ($db->isUserExisted($email)) {
        // user already existed
        //$response["error"] = TRUE;
        //$response["error_msg"] = "User already existed with " . $email;
        
        $user = $db->getUserByEmail($email);
        $response["error"] = FALSE;
        $response["user"]["name"] = $user["name"];
        $response["user"]["email"] = $user["email"];
        $response["user"]["age"] = $user["age"];
        $response["user"]["created_at"] = $user["created_at"];
        $response["user"]["updated_at"] = $user["updated_at"];
        $response["user"]["id"] = $user["id"];
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($name, $email, $password,$age);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["uid"] = $user["unique_id"];
            $response["user"]["name"] = $user["name"];
            $response["user"]["email"] = $user["email"];
            $response["user"]["age"] = $user["age"];
            $response["user"]["created_at"] = $user["created_at"];
            $response["user"]["updated_at"] = $user["updated_at"];
            $response["user"]["id"] = $user["id"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
//} else {
 //   $response["error"] = TRUE;
   // $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    //echo json_encode($response);
//}
?>