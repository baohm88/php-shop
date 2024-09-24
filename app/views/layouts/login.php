<?php
$error;
if (isset($_GET["error"])) {
  $error = "Incorrect username and/or password!";
}
?>

<form method="POST" class="login-form">
  <h2 class="center">Log In</h2>
  <p><input type="text" name="username" placeholder="Username" autofocus></p>
  <p><input type="password" name="password" placeholder="Password"></p>
  <p class="error-message"><?= isset($error) ? $error : "" ?></p>
  <input type="submit" value="Login">
  <br><br>
  <p>Have no account yet? <a href="http://localhost/shop/user/register">Register</a> here!</p>
</form>