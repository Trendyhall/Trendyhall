<?php 
function get_price($price, $sale = 0){
        return number_format($price * (0.01 * (100 - $sale)), 0,"."," ");
    }
?>
<?php if (isset($goods)): ?>
    <?php foreach ($goods as $key => $value): ?>
        
        <?php if ($value['count'] <= 0): ?>
            <span hidden data-delete-id="<?php echo $value['id'] ?>"></span>
        <?php endif ?>
        <?php if ($value['count'] > 0): ?>
            <div class="card mb-3">
              <div class="row g-0">
                <div class="col-md-3">
                  <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>"><img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$value['id'].".webp"; }?>" class="img-fluid" alt="..."></a>
                </div>
                <div class="col-md-9 text-md-start ps-md-4">
                    <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>"><div class="card-name"><?php echo $value['name']; ?></div></a>
                    <div class="card-brand"><?php echo $value['brand']; ?></div>
                    <?php if ($value['sale'] == 0): ?>
                        <div class="card-price"><?php echo get_price($value['price']); ?> ₽ </div>
                    <?php endif; ?>
                    <?php if ($value['sale'] > 0): ?>
                        <div style="font-size: 1rem; text-decoration: line-through;"><?php echo get_price($value['price']); ?> ₽</div>
                        <div class="card-price" style="color: #f00;"><?php echo get_price($value['price'], $value['sale']); ?> ₽</div>
                    <?php endif; ?>
                    <p class="mb-0">Размер: <?php echo $value['size'] ?></p>
                    <p class="mb-0">Количество: 
                        <select class="border-0" style="outline: none;">
                          <?php for ($i=1; $i <= $value['count']; $i++) { 
                              echo '<option value="'.$i.'">'.$i.'</option>';
                          } ?>
                        </select>
                    </p>
                    <button type="button" class="btn-close position-absolute top-0 end-0" aria-label="Close" data-closeid="<?php echo $value['id'] ?>"></button>
                </div>
              </div>
            </div>
        <?php endif ?>

    <?php endforeach ?>
<?php endif; ?>