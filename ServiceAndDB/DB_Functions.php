<?php
 
/**
 * @author Ravi Tamada
 * @link http://www.androidhive.info/2012/01/android-login-and-registration-with-php-mysql-and-sqlite/ Complete tutorial
 */
 
class DB_Functions {
 
    private $conn;
 
    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }
 
    // destructor
    function __destruct() {
         
    }
 
    /**
     * Storing new user
     * returns user details
     */
    public function storeUser($name, $email, $password,$age) {
        $uuid = uniqid('', true);
        $hash = $this->hashSSHA($password);
        $encrypted_password = $hash["encrypted"]; // encrypted password
        $salt = $hash["salt"]; // salt
 
        $stmt = $this->conn->prepare("INSERT INTO users(unique_id, name, email, encrypted_password, salt, created_at,age) VALUES(?, ?, ?, ?, ?, NOW(),?)");
        $stmt->bind_param("ssssss", $uuid, $name, $email, $encrypted_password, $salt, $age);
        $result = $stmt->execute();
        $stmt->close();
 
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
 
    /**
     * Get user by email and password
     */
    public function getUserByEmailAndPassword($email, $password) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            // verifying user password
            $salt = $user['salt'];
            $encrypted_password = $user['encrypted_password'];
            $hash = $this->checkhashSSHA($salt, $password);
            // check for password equality
            if ($encrypted_password == $hash) {
                // user authentication details are correct
                return $user;
            }
        } else {
            return NULL;
        }
    }
    
    public function getUserByEmail($email) {
 
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        if ($stmt->execute()) {
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return NULL;
        }
    }
 
    public function getUserFinishedLevels($userid, $stageid) {
    
        $stmt = $this->conn->prepare("SELECT PracticeID FROM userscore WHERE userid = ? AND stage =? order by PracticeID" );
        $stmt->bind_param("ss", $userid, $stageid);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $users =Array();
        $Index =0;
        while ($row = $result->fetch_assoc()) {
            $users[$Index] = $row;
            $Index    ++;
        }
        
        //$user = $stmt->get_result()->fetch_assoc();
        $stmt->close();
 
        return $users;
        
    }
 
 
    /**
     * Check user is existed or not
     */
    public function isUserExisted($email) {
        $stmt = $this->conn->prepare("SELECT email from users WHERE email = ?");
 
        $stmt->bind_param("s", $email);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }

    public function isUserIDExisted($Id) {
        $stmt = $this->conn->prepare("SELECT Id from users WHERE Id = ?");
 
        $stmt->bind_param("s", $Id);
 
        $stmt->execute();
 
        $stmt->store_result();
 
        if ($stmt->num_rows > 0) {
            // user existed 
            $stmt->close();
            return true;
        } else {
            // user not existed
            $stmt->close();
            return false;
        }
    }
 
    /**
     * Encrypting password
     * @param password
     * returns salt and encrypted password
     */
    public function hashSSHA($password) {
 
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        $hash = array("salt" => $salt, "encrypted" => $encrypted);
        return $hash;
    }
 
    /**
     * Decrypting password
     * @param salt, password
     * returns hash string
     */
    public function checkhashSSHA($salt, $password) {
 
        $hash = base64_encode(sha1($password . $salt, true) . $salt);
 
        return $hash;
    }
    
    public function SetUserSCore($userId, $practiceID, $userScore,$userTiming,$stage) {
        $uuid = uniqid('', true);
        
        $stmt = $this->conn->prepare("SELECT * FROM userscore WHERE UserId = ? AND PracticeID = ? AND stage= ?");
        $stmt->bind_param("sss", $userId,$practiceID,$stage);
        $stmt->execute();
        $user = $stmt->get_result()->fetch_assoc();
        
        if ($user) {
            $stmt = $this->conn->prepare("Update userscore Set Score= ?, Timing=?, updated_at = NOW() Where UserId = ? AND PracticeID = ? AND stage = ?");
            $stmt->bind_param("sssss",$userScore, $userTiming,$userId, $practiceID,$stage);
            $result = $stmt->execute();
            $stmt->close();
        }else{
            $stmt = $this->conn->prepare("INSERT INTO userscore(Unique_id, UserId, PracticeID, Score, Timing,stage, created_at) VALUES(?, ?, ?, ?, ?,?, NOW())");
            $stmt->bind_param("ssssss", $uuid, $userId, $practiceID, $userScore, $userTiming,$stage);
            $result = $stmt->execute();
            $stmt->close();
        }
        
        // check for successful store
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->bind_param("s", $userId);
            $stmt->execute();
            $user = $stmt->get_result()->fetch_assoc();
            $stmt->close();
 
            return $user;
        } else {
            return false;
        }
    }
 
 
 
}
 
?>