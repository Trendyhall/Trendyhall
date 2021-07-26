<?php foreach ($goods as $key => $value): ?>
    <?php if ($value['sale'] != 1) $Sale = $Othertables_model->GetByID("sales", "sale", $value['sale']); ?>
        <div class="card mb-3">
          <div class="row g-0">
            <div class="col-md-3">
              <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>"><img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$value['id'].".webp"; }?>" class="img-fluid" alt="..."></a>
            </div>
            <div class="col-md-6 text-md-start ps-md-4">
                <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>"><div class="card-name"><?php echo $value['name']; ?></div></a>
                <div class="card-brand"><?php echo $value['brand']; ?></div>
                <?php if ($value['sale'] == 1): ?>
                    <div class="card-price"><?php echo number_format($value['price'], 0,"."," "); ?> &#8381; </div>
                <?php endif; ?>
                <?php if ($value['sale'] != 1): ?>
                    <div style="font-size: 1rem; text-decoration: line-through;"><?php echo number_format($value['price'], 0,"."," "); ?> &#8381;</div>
                    <div class="card-price" style="color: #f00;"><?php echo number_format($value['price'] * (0.01 * (100 - $Sale)), 0,"."," "); ?> &#8381;</div>
                <?php endif; ?>
                <p class="mb-0">Размер: 8</p>
                <p class="mb-0">Количество: 
                    <select class="border-0" style="outline: none;">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                    </select>
                </p>
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-dark">Убрать</button>
            </div>
          </div>
        </div>
<?php endforeach ?>