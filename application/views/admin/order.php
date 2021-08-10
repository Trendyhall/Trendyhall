<div class="d-flex">
  <a class="btn btn-outline-dark mb-2 rounded-0" href="/admin/orders"><-- Назад</a>
  <label class="ms-auto mt-1" for="confirmCheck">Управление заказом</label>
  <input class="form-check-input m-1 mt-2" type="checkbox" id="confirmCheck" onclick="this.parentNode.querySelector('div').classList.toggle('d-none');">
 
  <div class="d-none">
    <a class="btn btn-success mb-2 rounded-0" href="/admin/order/<?php echo $order['id']; ?>/delete">Выполнить заказ</a>
    <a class="btn btn-danger mb-2 rounded-0" href="/admin/order/<?php echo $order['id']; ?>/cancel">Отменить заказ</a>
  </div>
</div>


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
        <td>Сумма заказа:</td>
        <td></td>
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
        <th scope="col">Артикул</th>
        <th scope="col">Количество</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($cart as $key => $value): ?>
        <tr onclick="this.classList.toggle('table-dark');">
          <th scope="row"><?php echo $key; ?></th>
          <th><img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/".$value['modelcode'].'_'.$value['colour'].".webp"; }?>" style="    max-width: 100px;" alt="..."></th>
          <td><?php echo $value['articule']; ?></td>
          <td><?php echo $cart_json[$value['id']]; ?></td>
        </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>