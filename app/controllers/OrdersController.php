<?php

class OrdersController extends BaseController
{
  private $__orderModel;

  function __construct($conn)
  {
    $this->__orderModel = $this->load_model('OrderModel', $conn);
  }

  function index()
  {
    // get user_id
    $userId = $_SESSION['user']->id;
    $data['orders'] = $this->__orderModel->getOrdersByUserId($userId);
    $data['page'] = 'layouts/client/order';
    $data['page_title'] = 'Orders';

    $this->view('layouts/client/client', $data);
  }
}
