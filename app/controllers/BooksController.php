<?php

class BooksController extends BaseController
{
  private $__bookModel;

  function __construct($conn)
  {
    $this->__bookModel = $this->load_model('BookModel', $conn);
  }

  function index()
  {

    $data['page'] = 'layouts/client/books';
    $data['page_title'] = 'Available Books';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter books
      $name = trim($_POST['name']);
      $stock_quantity = '';
      $price_in = '';
      $price_out = trim($_POST['price_out']);
      $data['books'] = $this->__bookModel->filterBooks($name, $price_in, $stock_quantity, $price_out);
    } else {
      // show all books
      $data['books'] = $this->__bookModel->getAllBooks();
    }


    $this->view('layouts/client/client', $data);
  }

  function book()
  {
    $bookId = $_REQUEST['id'];
    $data['page'] = 'layouts/client/bookDetail';
    $data['page_title'] = 'Book Detail';
    $data['book'] = $this->__bookModel->getBookById($bookId);
    $this->view('layouts/client/client', $data);
  }
}
