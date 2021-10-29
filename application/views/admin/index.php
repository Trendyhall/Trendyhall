<h3>Общее</h3>
<div class="list-group mb-3">
  <a href="/admin/orders" class="list-group-item list-group-item-action">Заказы  
    <?php if ($new_orders > 0): ?>
      <span class="badge bg-danger"><?php echo $new_orders; ?></span>
    <?php endif ?>
    <?php if ($notdone_orders > 0): ?>
      <span class="badge bg-dark"><?php echo $notdone_orders; ?></span>
    <?php endif ?>
    <?php if ($overtime_orders > 0): ?>
      <span class="badge bg-warning"><?php echo $overtime_orders; ?></span>
    <?php endif ?>
  </a>
  <a href="/admin/settings" class="list-group-item list-group-item-action">Настройки</a>
</div>
<h3>Специальные</h3>
<div class="list-group">
  <a href="/admin/tests" class="list-group-item list-group-item-action">Для тестов</a>
  <a href="/admin/database-upload" class="list-group-item list-group-item-action">database upload</a>
  <!--
  <a href="/admin/headers" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">See headers</a>
  <a href="/admin/databasedebug" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Database debug</a>
  <a href="/admin/fillucode" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">Fill ucode</a>
  <a  class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">A disabled link item</a>-->
</div>
<?php 

 ?>