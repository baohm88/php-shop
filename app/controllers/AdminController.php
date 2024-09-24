<?php
class AdminController extends BaseController
{
  private $__bookModel, $__authorModel, $__genreModel, $__publisherModel;

  function __construct($conn)
  {
    $this->__bookModel = $this->load_model('BookModel', $conn);
    $this->__authorModel = $this->load_model('AuthorModel', $conn);
    $this->__genreModel = $this->load_model('GenreModel', $conn);
    $this->__publisherModel = $this->load_model('PublisherModel', $conn);
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

  function edit_book()
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


  function delete_book()
  {
    $bookId = $_REQUEST['id'];
    $data['book'] = $this->__bookModel->deleteBookById($bookId);
    header("Location: http://localhost/shop/admin");
  }



  // AUTHORS CONTROLLER
  public function authors()
  {
    $data['page'] = 'layouts/admin/authors';
    $data['page_title'] = 'Authors Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter authors
      $name = trim($_POST['name']);
      $dob = trim($_POST['dob']);
      $data['authors'] = $this->__authorModel->filterAuthors($name, $dob);
    } else {
      // show all authors
      $data['authors'] = $this->__authorModel->getAllAuthors();
    }
    $this->view("layouts/admin/admin", $data);
  }

  function edit_author()
  {
    $data['page'] = 'layouts/admin/author_form';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Author';
        $authorId = $_REQUEST['id'];
        if (!$authorId > 0) {
          $data['error'] = 'Wrong Author ID. please enter a valid Author ID';
          $data['author'] = '';
        } else {
          // get author from db
          $data['author'] = $this->__authorModel->getAuthorById($authorId);
          if (empty($data['author'])) {
            $data['error'] = 'Author with ID# ' . $authorId . ' is not found!';
            $data['author'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Author';
        $data['author'] = '';
      };

      $this->view('layouts/admin/admin', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $dob = $_POST['dob'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update author by id
        $this->__authorModel->updateAuthorById($id, $name, $dob);
      } else {
        // save author to db
        $this->__authorModel->saveAuthorToDB($name, $dob);
      }

      header("Location: http://localhost/shop/admin/authors");
    }
  }


  function delete_author()
  {
    $authorId = $_REQUEST['id'];
    $data['author'] = $this->__authorModel->deleteAuthorById($authorId);
    header("Location: http://localhost/shop/admin/authors");
  }



  // GENRES CONTROLLER
  public function genres()
  {
    $data['page'] = 'layouts/admin/genres';
    $data['page_title'] = 'Genres Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter genres
      $name = trim($_POST['name']);
      $dob = trim($_POST['dob']);
      $data['genres'] = $this->__genreModel->filterGenres($name, $dob);
    } else {
      // show all genres
      $data['genres'] = $this->__genreModel->getAllGenres();
    }
    $this->view("layouts/admin/admin", $data);
  }


  function edit_genre()
  {
    $data['page'] = 'layouts/admin/genre_form';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Genre';
        $genreId = $_REQUEST['id'];
        if (!$genreId > 0) {
          $data['error'] = 'Wrong Genre ID. please enter a valid Genre ID';
          $data['genre'] = '';
        } else {
          // get genre from db
          $data['genre'] = $this->__genreModel->getGenreById($genreId);
          if (empty($data['genre'])) {
            $data['error'] = 'Genre with ID# ' . $genreId . ' is not found!';
            $data['genre'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Genre';
        $data['genre'] = '';
      };

      $this->view('layouts/admin/admin', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update genre by id
        $this->__genreModel->updateGenreById($id, $name);
      } else {
        // save genre to db
        $this->__genreModel->saveGenreToDB($name);
      }

      header("Location: http://localhost/shop/admin/genres");
    }
  }


  function delete_genre()
  {
    $genreId = $_REQUEST['id'];
    $data['genre'] = $this->__genreModel->deleteGenreById($genreId);
    header("Location: http://localhost/shop/admin/genres");
  }



  // publishers controller
  public function publishers()
  {
    $data['page'] = 'layouts/admin/publishers';
    $data['page_title'] = 'Publishers Page';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // filter publishers
      $name = trim($_POST['name']);
      $dob = trim($_POST['dob']);
      $data['publishers'] = $this->__publisherModel->filterPublishers($name, $dob);
    } else {
      // show all publishers
      $data['publishers'] = $this->__publisherModel->getAllPublishers();
    }
    $this->view("layouts/admin/admin", $data);
  }

  function edit_publisher()
  {
    $data['page'] = 'layouts/admin/publisher_form';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_REQUEST['id'])) {
        // edit
        $data['page_title'] = 'Edit Publisher';
        $publisherId = $_REQUEST['id'];
        if (!$publisherId > 0) {
          $data['error'] = 'Wrong Publisher ID. please enter a valid Publisher ID';
          $data['publisher'] = '';
        } else {
          // get publisher from db
          $data['publisher'] = $this->__publisherModel->getPublisherById($publisherId);
          if (empty($data['publisher'])) {
            $data['error'] = 'Publisher with ID# ' . $publisherId . ' is not found!';
            $data['publisher'] = '';
          }
        }
      } else {
        // add new
        $data['page_title'] = 'Add New Publisher';
        $data['publisher'] = '';
      };

      $this->view('layouts/admin/admin', $data);
    } else {
      // method = POST -> collect POST data
      $name = $_POST['name'];
      $address = $_POST['address'];
      $contact = $_POST['contact'];
      $id = $_POST['id'];
      if ($id > 0) {
        // update publisher by id
        $this->__publisherModel->updatePublisherById($id, $name, $address, $contact);
      } else {
        // save publisher to db
        $this->__publisherModel->savePublisherToDB($name);
      }

      header("Location: http://localhost/shop/admin/publishers");
    }
  }


  function delete_publisher()
  {
    $publisherId = $_REQUEST['id'];
    $data['publisher'] = $this->__publisherModel->deletePublisherById($publisherId);
    header("Location: http://localhost/shop/admin/publishers");
  }
}
