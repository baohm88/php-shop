<?php
$author = $data['author'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="button-12"><a href="http://localhost/shop/admin/authors">Back to Authors List</a></button>


<form method="POST" class="login-form">
  <span class="error-message"><?= $error ?? '' ?></span>
  <p>
    <input type="hidden" name="id" value="<?= $author->id ?? 0 ?>">
  </p>
  <p>
    <label for="">Author Name: </label>
    <input type="text" name="name" placeholder="Author name" value="<?= $author->name ?? '' ?>">
  </p>
  <p>
    <label for="">Author DOB: </label>
    <input type="date" name="dob" placeholder="Author DOB" value="<?= $author->dob ?? '' ?>">
  </p>
  <input type="submit" value="Save">

</form>