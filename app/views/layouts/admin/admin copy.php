<?php
$books = $data['books'];
// show_data($books);
?>

<h2 class="center">Welcome to Admin Page</h2>
<br>

<button class="button-12"><a href="http://localhost/shop/admin/edit">Add New Book</a></button>
<br>

<form action="">
  <input type="text" name="name" placeholder="Book Name">
  <input type="number" name="stock-qty" placeholder="Stock Qty">
  <input type="number" name="price-in" placeholder="Price In">
  <input type="number" name="price-out" placeholder="Price Out">
  <input type="submit" value="Search">
</form>
<br>

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
      <td class="center"><a href="http://localhost/shop/admin/book/?id=<?= $book->id ?>"><button class="success">View</button></a></td>
      <td class="center"><a href="http://localhost/shop/admin/edit/?id=<?= $book->id ?>"><button class="primary">Edit</button></a></td>
      <td class="center"><button class="danger" onclick="confirmDeleteBook(<?= $book->id ?>)">Delete</button></td>
    </tr>
  <?php endforeach ?>

</table>