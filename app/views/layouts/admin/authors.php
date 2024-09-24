<?php
$authors = $data['authors'];
?>

<h2 class="center">List of Authors</h2>
<br>

<button class="button-12"><a href="http://localhost/shop/admin/edit_author"><i class="bi bi-plus-lg"></i> Add New Book</a></button>
<br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>DOB</th>
    <th colspan="3" class="center">Actions</th>
  </tr>

  <?php foreach ($authors as $author): ?>
    <tr>
      <td><?= $author->id ?></td>
      <td><?= $author->name ?></td>
      <td><?= $author->dob ?></td>
      <!-- <td class="center"><a href="http://localhost/shop/admin/author/?id=<?= $author->id ?>"><button class="success"><i class="bi bi-eye-fill"></i> View</button></a></td> -->
      <td class="center"><a href="http://localhost/shop/admin/edit_author/?id=<?= $author->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a></td>
      <td class="center"><button class="danger" onclick="confirmDeleteAuthor(<?= $author->id ?>)"><i class="bi bi-trash3-fill"></i> Delete</button></td>
    </tr>
  <?php endforeach ?>

</table>