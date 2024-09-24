<?php
$genres = $data['genres'];
?>

<h2 class="center">List of Genres</h2>
<br>

<button class="button-12"><a href="http://localhost/shop/admin/edit_genre"><i class="bi bi-plus-lg"></i> Add New Genre</a></button>
<br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>

    <th colspan="3" class="center">Actions</th>
  </tr>

  <?php foreach ($genres as $genre): ?>
    <tr>
      <td><?= $genre->id ?></td>
      <td><?= $genre->name ?></td>

      <!-- <td class="center"><a href="http://localhost/shop/admin/genre/?id=<?= $genre->id ?>"><button class="success"><i class="bi bi-eye-fill"></i> View</button></a></td> -->
      <td class="center"><a href="http://localhost/shop/admin/edit_genre/?id=<?= $genre->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a></td>
      <td class="center"><button class="danger" onclick="confirmDeleteGenre(<?= $genre->id ?>)"><i class="bi bi-trash3-fill"></i> Delete</button></td>
    </tr>
  <?php endforeach ?>

</table>