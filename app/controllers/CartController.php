<?php

class CartController extends BaseController
{
  private $__cartModel;

  function __construct($conn)
  {
    $this->__cartModel = $this->load_model('CartModel', $conn);
  }

  function index()
  {
    // get user_id
    $userId = $_SESSION['user']->id;
    $data['cart'] = $this->__cartModel->getCartByUserId($userId);
    $data['page'] = 'layouts/client/cart';
    $data['page_title'] = 'Cart';

    $this->view('layouts/client/client', $data);
  }
}
