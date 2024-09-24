<?php

class AuthorModel
{
  private $__conn;

  public function __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getAllAuthors($limit = 100, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM authors ORDER BY id DESC LIMIT :limit OFFSET :offset";
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


  public function getAuthorById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM authors WHERE id = :id";
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


  public function saveAuthorToDB($name, $dob)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "INSERT INTO authors (name, dob) VALUES (:name, :dob)";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("dob", $dob, PDO::PARAM_STR);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function updateAuthorById($id, $name, $dob)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "UPDATE authors SET name = :name, dob = :dob WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("dob", $dob, PDO::PARAM_STR);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function deleteAuthorById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "DELETE FROM authors WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "Author with ID $id has been deleted successfully.";
        } else {
          echo "No Author found with ID $id";
        }
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function filterAuthors($name = '', $dob = '', $limit = 10, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM authors WHERE 1=1";
        $params = [];

        // add filters if provided
        if (!empty($name)) {
          $sql .= " AND name COLLATE UTF8_GENERAL_CI LIKE :name";
        }

        if (!empty($dob)) {
          $sql .= " AND dob = :dob";
          $params[':dob'] = $dob;
        }

        // sort authors by id DESC and limit results
        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // prepare sql stmt
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if (!empty($name)) {
          $inputName = "%$name%";
          $stmt->bindParam(':name', $inputName, PDO::PARAM_STR);
        }
        
        if (!empty($name)) {
          $inputName = "%$name%";
          $stmt->bindParam(':name', $inputName, PDO::PARAM_STR);
        }

        foreach ($params as $key => $value) {
          $stmt->bindParam($key, $value, PDO::PARAM_INT);
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
