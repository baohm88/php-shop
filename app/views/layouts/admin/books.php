<?php
$books = $data['books'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // filter books
  $name = trim($_POST['name']);
  $stock_quantity = trim($_POST['stock_quantity']);
  $price_in = trim($_POST['price_in']);
  $price_out = trim($_POST['price_out']);
}
?>

<h2 class="center">List of Books</h2>
<br>

<button class="button-12"><a href="http://localhost/shop/admin/edit_book"><i class="bi bi-plus-lg"></i> Add New Book</a></button>
<br>

<div class="center">
  <form method="POST">
    <input type="text" name="name" placeholder="Book Name" value="<?= !empty($name) ? $name : '' ?>">
    <input type="number" name="stock_quantity" placeholder="Stock Qty" value="<?= !empty($stock_quantity) ? $stock_quantity : '' ?>">
    <input type="number" name="price_in" placeholder="Price In" value="<?= !empty($price_in) ? $price_in : '' ?>">
    <input type="number" name="price_out" placeholder="Price Out" value="<?= !empty($price_out) ? $price_out : '' ?>">
    <input type="submit" value="Search">
  </form>
</div>


<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Stock Qty</th>
    <th>Price In</th>
    <th>Price Out</th>
    <th>Margin / 1 unit</th>
    <th colspan="3" class="center">Actions</th>
  </tr>

  <?php foreach ($books as $book): ?>
    <tr>
      <td><?= $book->id ?></td>
      <td><?= $book->name ?></td>
      <td><?= $book->stock_quantity ?></td>
      <td>$<?= number_format($book->price_in, 2, '.', ',') ?></td>
      <td>$<?= number_format($book->price_out, 2, '.', ',') ?></td>
      <td>$<?= number_format(($book->price_out - $book->price_in), 2, '.', ',') ?></td>
      <td class="center"><a href="http://localhost/shop/admin/book/?id=<?= $book->id ?>"><button class="success"><i class="bi bi-eye-fill"></i> View</button></a></td>
      <td class="center"><a href="http://localhost/shop/admin/edit_book/?id=<?= $book->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a></td>
      <td class="center"><button class="danger" onclick="confirmDeleteBook(<?= $book->id ?>)"><i class="bi bi-trash3-fill"></i> Delete</button></td>
    </tr>
  <?php endforeach ?>

</table>