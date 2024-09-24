<?php

class HomeController extends BaseController
{
  private $__bookModel;

  function __construct($conn)
  {
    $this->__bookModel = $this->load_model('BookModel', $conn);
  }

  function index()
  {
    $data['page'] = 'layouts/home';
    $data['page_title'] = 'Bookstore';
    $this->view('layouts/client/client', $data);
  }
}
