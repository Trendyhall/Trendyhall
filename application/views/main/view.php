

	<div class="col col-xs-12 col-sm-12 col-md-9 col-lg-9">
		<div class="row row-cols-2 row-cols-md-3 row-cols-lg-3 g-4">
			<?php foreach ($goods as $key => $value): ?>
				<div class="col">
					<a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>">
					    <div class="card h-100">
					        <img src="<?php if ($value['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$value['id'].".webp"; }?>" class="card-img-top" alt="...">
					        <div class="card-body">
						        <div class="card-brand"><?php echo $value['name']; ?></div>
				        		<div class="card-name"><?php echo $value['brand']; ?></div>
				        		<div class="card-price"><?php echo $value['price']; ?> &#8381;</div>
					        </div>
					    </div>
					</a>
				</div>
			<?php endforeach ?>
		</div>
	</div>
</div>



<div class="col col-xs-12 pagination-div">
	<nav aria-label="Page navigation example">
	  <?php echo $pagination; ?>
	</nav>
</div>