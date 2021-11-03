<div class="d-flex justify-content-between">
  <a class="btn btn-outline-dark mb-2 rounded-0" href="/admin"><-- Назад</a>
</div>
<div class="accordion" id="settingsAccordion">

  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-h2">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-c2" aria-expanded="false" aria-controls="panelsStayOpen-c2">
        Отображение заказов
      </button>
    </h2>
    <div id="panelsStayOpen-c2" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-h2">
      <div class="accordion-body">
          <form name="order_statuses_visability" action="/admin/set-setting/order_statuses_visability" method="POST">
            <?php $status = $this->config->item('order_statuses_visability'); ?>
            <?php foreach ($this->config->item('order_statuses') as $key => $value): ?>
              <div class="form-check">
                <input name="<?php echo $key; ?>" class="form-check-input" type="checkbox" value="1" id="flexCheckChecked<?php echo $key; ?>"<?php if ($status[$key]) echo " checked"; ?>>
                <label class="form-check-label" for="flexCheckChecked<?php echo $key; ?>"><?php echo $value; ?></label>
              </div>
            <?php endforeach ?>
            <button type="submit" class="btn btn-outline-dark mt-3">Сохронить</button>
          </form>
      </div>
    </div>
  </div>
  <!--
  <div class="accordion-item">
    <h2 class="accordion-header" id="panelsStayOpen-h2">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-c2" aria-expanded="false" aria-controls="panelsStayOpen-c2">
        Отображение заказов
      </button>
    </h2>
    <div id="panelsStayOpen-c2" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-h2">
      <div class="accordion-body">
          <form name="order_statuses_visability" action="/admin/set-setting" method="POST">
            < ?php $status = $this->config->item('order_statuses_visability'); ?>
            < ?php foreach ($this->config->item('order_statuses') as $key => $value): ?>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="< ?php echo $key; ?>" id="flexCheckChecked< ?php echo $key; ?>"< ?php if ($status[$key]) echo " checked"; ?>>
                <label class="form-check-label" for="flexCheckChecked< ?php echo $key; ?>">< ?php echo $value; ?></label>
              </div>
            < ?php endforeach ?>
            <div class="d-flex w-100 aligne-content-center">
              <button type="submit" class="btn btn-outline-dark">Сохронить</button>
            </div>
          </form>
      </div>
    </div>
  </div>
  -->
</div>