<?php
if ($_SESSION['user']) {
  $name = $_SESSION['user']->name;
}

$current_page = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $data['page_title'] ?></title>
  <link rel="stylesheet" href="http://localhost/shop/app/assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <header class="flex-container">
    <div>
      <a href="http://localhost/shop/admin"><img src="http://localhost/shop/app/assets/images/bookstore.png" alt="book title" class="logo"></a>

    </div>
    <div>
      <ul class="flex-container">
        <li><a href="http://localhost/shop/admin/index" class="nav-link <?= ($current_page == 'index' || $current_page == 'edit') ? 'active' : '' ?>"><i class="bi bi-house-heart-fill"></i> Books</a></li>
        <li><a href="http://localhost/shop/admin/authors" class="nav-link <?= ($current_page == 'authors') ? 'active' : '' ?>"><i class="bi bi-book-fill"></i> Authors</a></li>
        <li><a href="http://localhost/shop/admin/genres" class="nav-link <?= ($current_page == 'genres') ? 'active' : '' ?>"><i class="bi bi-journal-album"></i> Genres</a></li>
        <li><a href="http://localhost/shop/admin/publishers" class="nav-link <?= ($current_page == 'publishers') ? 'active' : '' ?>"><i class="bi bi-cart-check-fill"></i> Publishers</a></li>
        <?php if (isset($name)): ?>
          <li><a href="http://localhost/shop/user/logout" class="nav-link"><button><i class="bi bi-box-arrow-right"></i> Logout</button></a></li>

          <li> <button>Hi, <?= $name ?> <i class="bi bi-person-square" style="font-size: larger;"></i> </button></li>
        <?php else: ?>
          <li><a href="http://localhost/shop/user/login" class="nav-link"><button><i class="bi bi-box-arrow-in-right"></i> Login</button></a></li>
        <?php endif ?>
      </ul>
    </div>
  </header>
  <hr>
  <main>