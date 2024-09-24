<?php
$publisher = $data['publisher'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="button-12"><a href="http://localhost/shop/admin/publishers">Back to Publishers List</a></button>


<form method="POST" class="login-form">
  <span class="error-message"><?= $error ?? '' ?></span>
  <p>
    <input type="hidden" name="id" value="<?= $publisher->id ?? 0 ?>">
  </p>
  <p>
    <label for="">Publisher Name: </label>
    <input type="text" name="name" placeholder="Publisher name" value="<?= $publisher->name ?? '' ?>">
  </p>
  <p>
    <label for="">Publisher Address: </label>
    <input type="text" name="address" placeholder="Publisher address" value="<?= $publisher->address ?? '' ?>">
  </p>
  <p>
    <label for="">Publisher Contact: </label>
    <input type="text" name="contact" placeholder="Publisher contact" value="<?= $publisher->contact ?? '' ?>">
  </p>

  <input type="submit" value="Save">

</form>