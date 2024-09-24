<?php
$this->view('layouts/client/header', $data);
$this->view($data['page'], $data);
$this->view('layouts/client/footer', $data);
