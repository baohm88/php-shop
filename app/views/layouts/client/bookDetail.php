<?php
$book = $data['book'];
?>

<button class="button-12"><a href="http://localhost/shop/books">Back to Books List</a></button>

<div class="book-container">
  <div>
    <img src="http://localhost/shop/app/assets/images/professional-php.png" alt="Denim Jeans" class="book-image-detail">
  </div>
  <div class="book-details">
    <h3 class="book-title"><?= $book->name ?></h3>
    <hr>
    <div class="flex-container">
      <div>
        <p class="book-price">$<?= number_format($book->price_out, 2, '.', ',')  ?></p>
      </div>
      <div>
        <button class="cart-button">Add to Cart</button>
      </div>
    </div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <hr>
    <p class="book-publication-date">Published date: <?= $book->publication_date ?></p>
    <p>Publisher: <?= $book->publisher_id ?></p>
    <p>Author: <?= $book->author_id ?></p>
    <p>Genre: <?= $book->genre_id ?></p>
    <p>Genre: <?= $book->genre_id ?></p>

  </div>
</div>