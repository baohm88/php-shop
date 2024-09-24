<?php
if (!empty($data['error'])) {
  $error = $data['error'];
}
?>

<form method="POST" class="login-form">
  <h2 class="center">Register a new account</h2>
  <p class="error-message"><?= isset($error) ? $error : "" ?></p>
  <p><input type="text" name="name" placeholder="Your Name" autofocus></p>
  <p><input type="text" name="username" placeholder="Your Username"></p>
  <p><input type="password" name="password" placeholder="Password"></p>
  <p><input type="password" name="password2" placeholder="Confirm Password"></p>
  <input type="submit" value="Register">
  <br>
  <br>
  <p>Already have account? <a href="http://localhost/shop/user/login">Login</a> here!</p>
</form>