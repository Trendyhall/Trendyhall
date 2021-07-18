<?php foreach ($goods as $key => $value): ?>
    <?php if ($value['sale'] != 1) $Sale = $Othertables_model->GetByID("sales", "sale", $value['sale']); ?>
    <div class="col position-relative">
        <button class="btn like" data-likeid="<?php echo $value['id']; ?>"></button>
        <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>">
            <div class="card h-100">
                <img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$value['id'].".webp"; }?>" class="card-img-top" alt="...">
                <?php if ($value['sale'] != 1): ?>
                    <div class="sale-lable">-<?php echo $Sale ?>%</div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="card-brand"><?php echo $value['name']; ?></div>
                    <div class="card-name"><?php echo $value['brand']; ?></div>
                    <?php if ($value['sale'] == 1): ?>
                        <div class="card-price"><?php echo number_format($value['price'], 0,"."," "); ?> &#8381; </div>
                    <?php endif; ?>
                    <?php if ($value['sale'] != 1): ?>
                        <div style="font-size: 1rem; text-decoration: line-through;"><?php echo number_format($value['price'], 0,"."," "); ?> &#8381;</div>
                        <div class="card-price" style="color: #f00;"><?php echo number_format($value['price'] * (0.01 * (100 - $Sale)), 0,"."," "); ?> &#8381;</div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    </div>
<?php endforeach ?>