<?php 
class UserModel {
    private $__conn;
    public function  __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getUserByUsernameANDPassword($username, $pass) {
        try {
            if (isset($this->__conn)) {
                $sql = "select * from users where username = :username AND password = :pass";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("pass", $pass,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch(PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

?>