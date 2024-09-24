<?php
$this->view('layouts/admin/header', $data);
$this->view($data['page'], $data);
$this->view('layouts/admin/footer', $data);
