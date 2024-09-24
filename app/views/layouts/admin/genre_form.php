<?php
$genre = $data['genre'];

if (isset($data['error'])) {
  $error = $data['error'];
}

?>

<h1 class="center"><?= $data['page_title'] ?></h1>

<button class="button-12"><a href="http://localhost/shop/admin/genres">Back to Genres List</a></button>


<form method="POST" class="login-form">
  <span class="error-message"><?= $error ?? '' ?></span>
  <p>
    <input type="hidden" name="id" value="<?= $genre->id ?? 0 ?>">
  </p>
  <p>
    <label for="">Genre Name: </label>
    <input type="text" name="name" placeholder="Genre name" value="<?= $genre->name ?? '' ?>">
  </p>

  <input type="submit" value="Save">

</form>