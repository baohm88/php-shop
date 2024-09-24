<?php
class UserModel
{
    private $__conn;
    public function  __construct($conn)
    {
        $this->__conn = $conn;
    }

    public function getUserByUsernameAndPassword($username, $pass)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select * from users where username = :username AND password = :pass";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("pass", $pass, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function getUserByUsername($username)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select * from users where username = :username";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }


    public function getPasswordByUsername($username)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "select password from users where username = :username";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_OBJ);
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    public function registerNewUser($name, $username, $password)
    {
        try {
            if (isset($this->__conn)) {
                $sql = "INSERT INTO users (name, username, password) 
                        VALUES (:name, :username, :password)";
                $stmt = $this->__conn->prepare($sql);
                $stmt->bindParam("name", $name, PDO::PARAM_STR);
                $stmt->bindParam("username", $username, PDO::PARAM_STR);
                $stmt->bindParam("password", $password, PDO::PARAM_STR);
                $stmt->execute();
            }
            return null;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}
