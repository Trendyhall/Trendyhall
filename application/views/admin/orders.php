<div class="d-flex justify-content-between">
  <a class="btn btn-outline-dark mb-2 rounded-0" href="/admin"><-- Назад</a>
</div>
<?php if (!$orders): ?>
  <div class="d-flex justify-content-center">
    <h2>Заказов нет</h2>
  </div>
<?php endif; ?>
<?php if ($orders): ?>
<div class="row mb-3">
  <div class="col-10 pe-0">
    <div class="form-floating">
        <input type="text" name="number" class="form-control" id="numberSearch" placeholder="Номер заказа">
        <label for="numberSearch">Номер заказа</label>
    </div>
  </div>
  <div class="col-2 ps-1">
    <button class="btn btn-outline-dark w-100 h-100" type="button" onclick="document.location = '/admin/orders/'+document.getElementById('numberSearch').value;">Найти</button>
  </div>
</div>

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

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Статус</th>
      <th scope="col">Номер заказа</th>
      <th scope="col">Дата заказа</th>
      <th scope="col">Телефон</th>
      <th scope="col">Тип заказа</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($orders as $key => $value): ?>
      <tr onclick="document.location = '/admin/orders/<?php echo $value['id']; ?>';">
        <th scope="row"><?php echo $key+1; ?></th>
        <th scope="row"<?php $get_st->get_d_class($value['status']); ?>><?php $get_st->get_status($value['status']); ?></th>
        <th scope="row" ><?php echo $value['id']; ?></th>
        <td><?php echo $value['ordertime']; ?></td>
        <td><?php echo $value['phone']; ?></td>
        <td><?php if ($value['deliverytype'] == 1) echo 'Доставка'; if ($value['deliverytype'] == 2) echo 'Самовывоз'; ?></td>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>  
<?php endif; ?>