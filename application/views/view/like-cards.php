<?php foreach ($goods as $key => $value): ?>
    <div class="col position-relative">
        <button class="btn like" data-likeid="<?php echo $value['id']; ?>"></button>
        <a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>">
            <div class="card h-100">
                <img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/".$value['modelcode'].'_'.$value['colour'].".webp"; }?>" class="card-img-top" alt="...">
                <?php if ($value['sale'] != 0): ?>
                    <div class="sale-lable">-<?php echo $value['sale'] ?>%</div>
                <?php endif; ?>
                <div class="card-body">
                    <div class="card-name"><?php echo $value['name']; ?></div>
                    <div class="card-brand"><?php echo $value['brand']; ?></div>
                    <?php if ($value['sale'] == 0): ?>
                        <div class="card-price"><?php echo get_price($value['price']); ?> ₽ </div>
                    <?php endif; ?>
                    <?php if ($value['sale'] > 0): ?>
                        <div style="font-size: 1rem; text-decoration: line-through;"><?php echo get_price($value['price']); ?> ₽</div>
                        <div class="card-price" style="color: #f00;"><?php echo get_price($value['price'], $value['sale']); ?> ₽</div>
                    <?php endif; ?>
                </div>
            </div>
        </a>
    </div>
<?php endforeach ?>