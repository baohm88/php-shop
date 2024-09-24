<?php
$publishers = $data['publishers'];
?>

<h2 class="center">List of Publishers</h2>
<br>

<button class="button-12"><a href="http://localhost/shop/admin/edit_publisher"><i class="bi bi-plus-lg"></i> Add New Publisher</a></button>
<br>

<table>
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Address</th>
    <th>Contact</th>

    <th colspan="3" class="center">Actions</th>
  </tr>

  <?php foreach ($publishers as $publisher): ?>
    <tr>
      <td><?= $publisher->id ?></td>
      <td><?= $publisher->name ?></td>
      <td><?= $publisher->address ?></td>
      <td><?= $publisher->contact ?></td>

      <!-- <td class="center"><a href="http://localhost/shop/admin/publisher/?id=<?= $publisher->id ?>"><button class="success"><i class="bi bi-eye-fill"></i> View</button></a></td> -->
      <td class="center"><a href="http://localhost/shop/admin/edit_publisher/?id=<?= $publisher->id ?>"><button class="primary"><i class="bi bi-pen-fill"></i> Edit</button></a></td>
      <td class="center"><button class="danger" onclick="confirmDeletePublisher(<?= $publisher->id ?>)"><i class="bi bi-trash3-fill"></i> Delete</button></td>
    </tr>
  <?php endforeach ?>

</table>