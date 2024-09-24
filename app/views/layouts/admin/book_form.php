<?php
$book = $data['book'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="button-12"><a href="http://localhost/shop/admin">Back to Books List</a></button>


<form method="POST" class="login-form">
  <span class="error-message"><?= $error ?? '' ?></span>
  <p>
    <input type="hidden" name="id" value="<?= $book->id ?? 0 ?>">
  </p>
  <p>
    <label for="">Book Name: </label>
    <input type="text" name="name" placeholder="Book name" value="<?= $book->name ?? '' ?>">
  </p>
  <p>
    <label for="">Image URL: </label>
    <input type=" text" name="image" placeholder="Book Image" value="<?= $book->image ?? '' ?>">
  </p>
  <p>
    <label for="">Stock Quantity: </label>
    <input type="number" name="stock_quantity" placeholder="Stock quantity" value="<?= $book->stock_quantity ?? '' ?>">
  </p>
  <p>
    <label for="">Price In: </label>
    <input type="number" name="price_in" placeholder="Price In" value="<?= $book->price_in ?? '' ?>">
  </p>
  <p>
    <label for="">Price Out: </label>
    <input type="number" name="price_out" placeholder="Price Out" value="<?= $book->price_out ?? '' ?>">
  </p>
  <p>
    <label for="">Author ID: </label>
    <input type="number" name="author_id" placeholder="Author ID" value="<?= $book->author_id ?? '' ?>">
  </p>
  <p>
    <label for="">Genre ID: </label>
    <input type="number" name="genre_id" placeholder="Genre ID" value="<?= $book->genre_id ?? '' ?>">
  </p>
  <p>
    <label for="">Publisher ID: </label>
    <input type="number" name="publisher_id" placeholder="Publisher ID" value="<?= $book->publisher_id ?? '' ?>">
  </p>
  <p>
    <label for="">Publication Date: </label>
    <input type="date" name="publication_date" placeholder="Publication Date" value="<?= $book->publication_date ?? '' ?>">
  </p>

  <input type="submit" value="Save">

</form>