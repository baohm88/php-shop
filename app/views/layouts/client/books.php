<?php
$books = $data['books'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // filter books
  $name = trim($_POST['name']);
  $price_out = trim($_POST['price_out']);
}
?>

<h1 class="center">List of Available Books </h1>

<form method="POST" class="center">
  <input type="text" name="name" placeholder="Book Name" value="<?= !empty($name) ? $name : '' ?>">
  <input type="number" name="price_out" placeholder="Price" value="<?= !empty($price_out) ? $price_out : '' ?>">
  <input type="submit" value="Search">
</form>
<br>

<div class="books-container">
  <?php if (!empty($books)): ?>
    <?php foreach ($books as $book): ?>
      <div class="book-card center">
        <!-- <a href="http://localhost/shop/book/detail/?id=<?= $book->id ?>"> -->
        <a href="http://localhost/shop/books/book/?id=<?= $book->id ?>">
          <img src="<?= $book->image ?>" alt="<?= $book->$name ?>" class="book-image">
          <h3 class="book-title"><?= $book->name ?></h3>
        </a>
        <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>
        <p class="book-publication-date"><?= $book->publication_date ?></p>
        <p><button class="cart-button">Add to Cart</button></p>
      </div>

    <?php endforeach ?>
  <?php else: ?>
    <h3 class="center">There is no books.</h3>
  <?php endif ?>

</div>