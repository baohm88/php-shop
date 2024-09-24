<?php


if (!empty($data['orders'])) {
  $orders = $data['orders'];
} 
?>

<h1 class="center">Yours Order</h1>
<?php if ($orders) : ?>
  <ul>
    <?php foreach ($orders as $order): ?>
      <li>
        <p>Order Id: <?= $order->id ?></p>
        <p>Order Total: <?= $order->total_orders ?></p>
        <p>Order Date: <?= $order->order_date ?></p>
      </li>
      <hr>
    <?php endforeach ?>
  </ul>

<?php else: ?>
  <h3 class="center">You have no orders yet. <strong>Shop now!</strong></h3>
<?php endif ?>