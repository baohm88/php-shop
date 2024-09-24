<?php

class BookModel
{
  private $__conn;

  public function __construct($conn)
  {
    $this->__conn = $conn;
  }

  public function getAllBooks($limit = 100, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM books ORDER BY id DESC LIMIT :limit OFFSET :offset";
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


  public function getBookById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM books WHERE id = :id";
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


  public function saveBookToDB($name, $image, $stock_quantity, $price_in, $price_out, $author_id, $genre_id, $publisher_id, $publication_date)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "INSERT INTO books (name, image, stock_quantity, price_in, price_out, author_id, genre_id, publisher_id, publication_date) 
                VALUES (:name, :image, :stock_quantity, :price_in, :price_out, :author_id, :genre_id, :publisher_id, :publication_date)";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("image", $image, PDO::PARAM_STR);
        $stmt->bindParam("stock_quantity", $stock_quantity, PDO::PARAM_INT);
        $stmt->bindParam("price_in", $price_in, PDO::PARAM_INT);
        $stmt->bindParam("price_out", $price_out, PDO::PARAM_INT);
        $stmt->bindParam("author_id", $author_id, PDO::PARAM_INT);
        $stmt->bindParam("genre_id", $genre_id, PDO::PARAM_INT);
        $stmt->bindParam("publisher_id", $publisher_id, PDO::PARAM_INT);
        $stmt->bindParam("publication_date", $publication_date, PDO::PARAM_STR);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function updateBookById($id, $name, $image, $stock_quantity, $price_in, $price_out, $author_id, $genre_id, $publisher_id, $publication_date)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "UPDATE books
                SET name = :name, image = :image, stock_quantity = :stock_quantity, price_in = :price_in, price_out = :price_out, author_id = :author_id, genre_id = :genre_id, publisher_id = :publisher_id, publication_date = :publication_date
                WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam("name", $name, PDO::PARAM_STR);
        $stmt->bindParam("image", $image, PDO::PARAM_STR);
        $stmt->bindParam("stock_quantity", $stock_quantity, PDO::PARAM_INT);
        $stmt->bindParam("price_in", $price_in, PDO::PARAM_INT);
        $stmt->bindParam("price_out", $price_out, PDO::PARAM_INT);
        $stmt->bindParam("author_id", $author_id, PDO::PARAM_INT);
        $stmt->bindParam("genre_id", $genre_id, PDO::PARAM_INT);
        $stmt->bindParam("publisher_id", $publisher_id, PDO::PARAM_INT);
        $stmt->bindParam("publication_date", $publication_date, PDO::PARAM_STR);
        $stmt->bindParam("id", $id, PDO::PARAM_INT);
        $stmt->execute();
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function deleteBookById($id)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
          echo "Book with ID $id has been deleted successfully.";
        } else {
          echo "No Book found with ID $id";
        }
      }
      return null;
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
  }


  public function filterBooks($name = '', $price_in = '', $stock_quantity = '', $price_out = '', $limit = 10, $offset = 0)
  {
    try {
      if (isset($this->__conn)) {
        $sql = "SELECT * FROM books WHERE 1=1";
        $params = [];

        // add filters if provided
        if (!empty($name)) {
          $sql .= " AND name COLLATE UTF8_GENERAL_CI LIKE :name";
        }

        if (!empty($price_in)) {
          $sql .= " AND price_in = :price_in";
          $params[':price_in'] = $price_in;
        }

        if (!empty($stock_quantity)) {
          $sql .= " AND stock_quantity = :stock_quantity";
          $params[':stock_quantity'] = $stock_quantity;
        }

        if (!empty($price_out)) {
          $sql .= " AND price_out = :price_out";
          $params[':price_out'] = $price_out;
        }

        // sort books by id DESC and limit results
        $sql .= " ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // prepare sql stmt
        $stmt = $this->__conn->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

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
