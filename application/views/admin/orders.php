<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Дата заказа</th>
      <th scope="col">Тип заказа</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $key => $value): ?>
      <tr onclick="document.location = '/admin/orders/<?php echo $value['id']; ?>';">
        <th scope="row"><?php echo $value['id']; ?></th>
        <td><?php echo $value['ordertime']; ?></td>
        <td><?php if ($value['deliverytype'] == 1) echo 'Доставка'; if ($value['deliverytype'] == 2) echo 'Самомвывоз'; ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>