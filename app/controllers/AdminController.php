<?php
class AdminController extends BaseController
{
  private $__bookModel;

  function __construct($conn)
  {
    $this->__bookModel = $this->load_model('BookModel', $conn);
  }

  // books controller
  public function index()
  {
    $data['page'] = 'layouts/admin/books';
    $data['page_title'] = 'Books Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter books
      $name = trim($_POST['name']);
      $stock_quantity = trim($_POST['stock_quantity']);
      $price_in = trim($_POST['price_in']);
      $price_out = trim($_POST['price_out']);
      $data['books'] = $this->__bookModel->filterBooks($name, $price_in, $stock_quantity, $price_out);
    } else {
      // show all books
      
      $data['books'] = $this->__bookModel->getAllBooks();
    }
    
    $this->view("layouts/admin/admin", $data);
  }
  

  function book()
  {
    $bookId = $_REQUEST['id'];
    $data['page'] = 'layouts/admin/bookDetail';
    $data['page_title'] = 'Book Detail';
    $data['book'] = $this->__bookModel->getBookById($bookId);
    $this->view('layouts/admin/admin', $data);
  }

  function edit()
  {
    $data['page'] = 'layouts/admin/book_form';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Book';
        $bookId = $_REQUEST['id'];
        if (!$bookId > 0) {
          $data['error'] = 'Wrong Book ID. please enter a valid Book ID';
          $data['book'] = '';
        } else {
          // get book from db
          $data['book'] = $this->__bookModel->getBookById($bookId);
          if (empty($data['book'])) {
            $data['error'] = 'Book with ID# ' . $bookId . ' is not found!';
            $data['book'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Book';
        $data['book'] = '';
      };

      $this->view('layouts/admin/admin', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $image = $_POST['image'];
      $stock_quantity = $_POST['stock_quantity'];
      $price_in = $_POST['price_in'];
      $price_out = $_POST['price_out'];
      $author_id = $_POST['author_id'];
      $genre_id = $_POST['genre_id'];
      $publisher_id = $_POST['publisher_id'];
      $publication_date = $_POST['publication_date'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update book by id
        $this->__bookModel->updateBookById($id, $name, $image, $stock_quantity, $price_in, $price_out, $author_id, $genre_id, $publisher_id, $publication_date);
      } else {
        // save book to db
        $this->__bookModel->saveBookToDB($name, $image, $stock_quantity, $price_in, $price_out, $author_id, $genre_id, $publisher_id, $publication_date);
      }

      header("Location: http://localhost/shop/admin");
    }
  }


  function delete()
  {
    $bookId = $_REQUEST['id'];
    $data['book'] = $this->__bookModel->deleteBookById($bookId);
    header("Location: http://localhost/shop/admin");
  }

  // authors controller
  public function authors()
  {
    $data['page'] = 'layouts/admin/authors';
    $data['page_title'] = 'Authors Page';
    // $data['books'] = $this->__bookModel->getAllBooks();
    $this->view("layouts/admin/admin", $data);
  }


  // genres controller
  public function genres()
  {
    $data['page'] = 'layouts/admin/genres';
    $data['page_title'] = 'Genres Page';
    // $data['books'] = $this->__bookModel->getAllBooks();
    $this->view("layouts/admin/admin", $data);
  }

  // publishers controller
  public function publishers()
  {
    $data['page'] = 'layouts/admin/publishers';
    $data['page_title'] = 'Publishers Page';
    // $data['books'] = $this->__bookModel->getAllBooks();
    $this->view("layouts/admin/admin", $data);
  }
}
