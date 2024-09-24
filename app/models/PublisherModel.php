<?php

class PublisherModel
{
  private $__conn;

  public function __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getAllPublishers($limit = 100, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM publishers ORDER BY id DESC LIMIT :limit OFFSET :offset";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam("offset", $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      echo "no connection";
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function getPublisherById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM publishers WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
      }
      echo "no connection";
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function savePublisherToDB($name, $address, $contact)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "INSERT INTO publishers (name, address, contact) VALUES (:name, :address, :contact)";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("address", $address, PDO::PARAM_STR);
        $stmt->bindParam("contact", $contact, PDO::PARAM_STR);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function updatePublisherById($id, $name, $address, $contact)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "UPDATE publishers SET name = :name, address = :address, contact = :contact WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("address", $address, PDO::PARAM_STR);
        $stmt->bindParam("contact", $contact, PDO::PARAM_STR);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function deletePublisherById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "DELETE FROM publishers WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "Publisher with ID $id has been deleted successfully.";
        } else {
          echo "No Publisher found with ID $id";
        }
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function filterPublishers($name = '', $address = '', $contact = '', $limit = 10, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM publishers WHERE 1=1";
        $params = [];

        // add filters if provided
        if (!empty($name)) {
          $sql .= " AND name LIKE :name";
          $params[':name'] = $name;
        }
        if (!empty($address)) {
          $sql .= " AND address LIKE :address";
          $params[':address'] = $address;
        }
        if (!empty($contact)) {
          $sql .= " AND contact LIKE :contact";
          $params[':contact'] = $contact;
        }


        // sort publishers by id DESC and limit results
        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // prepare sql stmt
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        foreach ($params as $key => $value) {
          $stmt->bindParam($key, $value);
        }

        // execute sql stmt
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
      }
      echo "no connection";
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }
}
