<?php
$cart = $data['cart'];

if (!empty($cart)) {
  show_data('YES');
} else {
  show_data('NO');
}
?>

<h1 class="center">Your Cart</h1>
<?php if ($cart) : ?>
  you have some items in your cart

<?php else: ?>
  <h3 class="center">You have no items in your cart yet. <strong>Shop now!</strong></h3>
<?php endif ?>