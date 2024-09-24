<?php
class CartModel
{
  private $__conn;
  public function  __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getCartByUserId($userId)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM carts WHERE user_id = :user_id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("user_id", $userId, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }
}
