<?php

class GenreModel
{
  private $__conn;

  public function __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getAllGenres($limit = 100, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM genres ORDER BY id DESC LIMIT :limit OFFSET :offset";
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


  public function getGenreById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM genres WHERE id = :id";
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


  public function saveGenreToDB($name)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "INSERT INTO genres (name) VALUES (:name)";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function updateGenreById($id, $name)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "UPDATE genres SET name = :name WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function deleteGenreById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "DELETE FROM genres WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "Genre with ID $id has been deleted successfully.";
        } else {
          echo "No Genre found with ID $id";
        }
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function filterGenres($name = '', $limit = 10, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM genres WHERE 1=1";
        $params = [];

        // add filters if provided
        if (!empty($name)) {
          $sql .= " AND name COLLATE UTF8_GENERAL_CI LIKE :name";
        }

        // sort genres by id DESC and limit results
        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // prepare sql stmt
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        if (!empty($name)) {
          $inputName = "%$name%";
          $stmt->bindParam(':name', $inputName, PDO::PARAM_STR);
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
