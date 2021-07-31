<h4>Номер заказа: <?php echo $order['id']; ?></h4>
<h4>Код подтверждения: <?php echo $order['passcode']; ?></h4>
<h4>Тип доставки: <?php if ($order['deliverytype'] == 1) echo 'Доставка'; if ($order['deliverytype'] == 2) echo 'Самомвывоз'; ?></h4>
<h4>Дата заказа: <?php echo $order['ordertime']; ?></h4>

<h4>Ф.И.О: <?php echo $order['name']; ?></h4>
<h4>Телефон: <?php echo $order['phone']; ?></h4>
<?php if ($order['deliverytype'] == 1): ?>
  <h4>Адрес: <?php echo $order['address']; ?></h4>
<?php endif ?>

<h4>Комментарий заказчика:</h4>
<h4><?php echo $order['comment']; ?></h4>

<button class="btn btn-outline-dark mb-2" type="button">Удалить заказ</button>

<button class="btn btn-outline-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#cartCollapse" aria-expanded="false" aria-controls="cartCollapse">
  Список товаров
</button>
<div class="collapse" id="cartCollapse">
    <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Фото</th>
        <th scope="col">Артикул</th>
        <th scope="col">Количество</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $key => $value): ?>
        <tr onclick="this.classList.toggle('table-dark');">
          <th scope="row"><?php echo $key; ?></th>
          <th><img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$value['id'].".webp"; }?>" style="    max-width: 100px;" alt="..."></th>
          <td><?php echo $value['articule']; ?></td>
          <td><?php echo $cart_json[$value['id']]; ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>