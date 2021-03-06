<?php 
class GetStatus {
  function __construct($config)
  {
    $this->statuses = $config->item('order_statuses');
    $this->statuses_classes = $config->item('order_statuses_classes');
  }

  function get_status($st){
    echo $this->statuses[$st];
  }

  function get_d_class($st){
    if (array_key_exists($st, $this->statuses_classes)) echo "class='".$this->statuses_classes[$st]."'";
  }
}

$get_st = new GetStatus($this->config);
 ?>

 <div class="d-flex justify-content-between">
  <a class="btn btn-outline-dark mb-2 rounded-0" href="/admin/orders"><-- Назад</a>

  <div class="btn-group mb-2">
    <button type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      <line <?php $get_st->get_d_class($order['status']); ?>><?php $get_st->get_status($order['status']); ?></line>
    </button>
    <ul class="dropdown-menu">
      <?php if ($order['status'] == 0): ?>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/1">Пометить как <b>просмотренное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/4">Пометить как <b class="text-success">выполненное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/2">Пометить как <b class="text-warning">просроченное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/3">Пометить как <b class="text-danger">отменённое и вернуть товар на сайт</b></a></li>
      <?php endif ?>
      <?php if ($order['status'] == 1): ?>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/0">Пометить как <b>непросмотренное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/4">Пометить как <b class="text-success">выполненное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/2">Пометить как <b class="text-warning">просроченное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/3">Пометить как <b class="text-danger">отменённое и вернуть товар на сайт</b></a></li>
      <?php endif ?>
      <?php if ($order['status'] == 2): ?>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/4">Пометить как <b class="text-success">выполненное</b></a></li>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/3">Пометить как <b class="text-danger">отменённое и вернуть товар на сайт</b></a></li>
      <?php endif ?>
      <?php if ($order['status'] == 4): ?>
        <li><a class="dropdown-item" href="/admin/order/<?php echo $order['id']; ?>/set-status/3">Пометить как <b class="text-danger">отменённое и вернуть товар на сайт</b></a></li>
      <?php endif ?>
    </ul>
  </div>
</div>

<?php 
  $order_price = 0;
  foreach ($cart as $key => $value) $order_price += ((int)$value['price']) * ((int)$cart_json[$value['id']]) * (1 - ((float)$value['sale'])/100);
 ?>

<table class="table">
  <tbody>
      <tr>
        <td>Номер заказа:</td>
        <td><?php echo $order['id']; ?></td>
      </tr>
      <tr>
        <td>Код подтверждения:</td>
        <td><?php echo $order['passcode']; ?></td>
      </tr>
      <tr>
        <td>Тип доставки:</td>
        <td><?php if ($order['deliverytype'] == 1) echo 'Доставка'; if ($order['deliverytype'] == 2) echo 'Самомвывоз'; ?></td>
      </tr>
      <tr>
        <td>Дата заказа:</td>
        <td><?php echo $order['ordertime']; ?></td>
      </tr>
      <tr>
        <td>Ф.И.О:</td>
        <td><?php echo $order['name']; ?></td>
      </tr>
      <tr>
        <td>Телефон:</td>
        <td><?php echo $order['phone']; ?></td>
      </tr>
      <?php if ($order['deliverytype'] == 1): ?>
        <tr>
          <td>Адрес:</td>
          <td><?php echo $order['address']; ?></td>
        </tr>
      <?php endif ?>
      <tr>
        <td>Комментарий заказчика:</td>
        <td><?php echo $order['comment']; ?></td>
      </tr>
      <tr>
        <td>Общая стоимость заказа:</td>
        <td><?php echo $order_price ?> ₽</td>
      </tr>
  </tbody>
</table>

<button class="btn btn-outline-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#cartCollapse" aria-expanded="false" aria-controls="cartCollapse">
  Показать список товаров
</button>
<div class="collapse" id="cartCollapse">
    <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Фото</th>
        <th scope="col">Ссылка на товар</th>
        <th scope="col">Артикул</th>
        <th scope="col">Название</th>
        <th scope="col">Цвет</th>
        <th scope="col">Размер</th>
        <th scope="col">Бренд</th>
        <th scope="col">Количество</th>
        <th scope="col">Цена</th>
        <th scope="col">Скидка</th>
        <th scope="col">Цена итог</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $key => $value): ?>
        <tr onclick="this.classList.toggle('table-dark');">
          <th scope="row"><?php echo $key+1; ?></th>
          <th><img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/".$value['modelcode'].'_'.$value['colour'].".webp"; }?>" style="max-width: 100px;" alt="..."></th>
          <td><a href="/goods/<?php echo $value['id']; ?>"><?php echo $value['id']; ?></a></td>
          <td><?php echo $value['articule']; ?></td>
          <td><?php echo $value['name']; ?></td>
          <td><?php echo $value['colour']; ?></td>
          <td><?php echo $value['size']; ?></td>
          <td><?php echo $value['brand']; ?></td>
          <td><?php echo $cart_json[$value['id']]; ?></td>
          <td><?php echo $value['price']; ?> ₽ x <?php echo $cart_json[$value['id']]; ?></td>
          <td><?php echo $value['sale']; ?>%</td>
          <td><?php echo ((int)$value['price']) * ((int)$cart_json[$value['id']]) * (1 - ((float)$value['sale'])/100); ?> ₽</td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>