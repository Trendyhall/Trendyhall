			<div class="col col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<div class="sort">
				  	<button class="" type="button" data-toggle="collapse" data-target="#collapseSort" aria-expanded="false" aria-controls="collapseExample">Сортировать<span>&#10095;</span></button>
					<div class="collapse" id="collapseSort">
					    <a href="#"><div class="active toggle"><div></div><div>По умолчанию</div></div></a>
					    <a href="#"><div class="toggle"><div></div><div>По возрастанию цены</div></div></a>
					    <a href="#"><div class="toggle"><div></div><div>По убыванию цены</div></div></a>
					    <a href="#"><div class="toggle"><div></div><div>Сначала новые товары</div></div></a>
					    <a href="#"><div class="toggle"><div></div><div>Сначала старые товары</div></div></a>
					</div>
				</div>

				<div class="filters">
					<button class="" type="button" data-toggle="collapse" data-target="#collapseColor" aria-expanded="false" aria-controls="collapseExample">Цвет<span>&#10095;</span></button>
					<div class="collapse" id="collapseColor">
					    <a href="#"><div class="active toggle"><div></div><div>чёрный</div></div></a><!--&#10004;-->
					    <a href="#"><div class="toggle"><div></div><div>белый</div></div></a>
					</div>
					<button class="" type="button" data-toggle="collapse" data-target="#collapseSize" aria-expanded="false" aria-controls="collapseExample">Размер<span>&#10095;</span></button>
					<div class="collapse" id="collapseSize">
					    <a href="#"><div class="toggle"><div></div><div>8</div></div></a>
					    <a href="#"><div class="active toggle"><div></div><div>10</div></div></a>
					</div>
				</div>
			</div>


			<div class="col col-xs-12 col-sm-12 col-md-9 col-lg-9">
				<div class="row">
					<?php foreach ($goods as $key => $value): ?>
		            	<div class="col card col-xs-6 col-sm-4 col-md-4 col-lg-4">
		            		<a href="/goods/<?php echo $value['articule']; ?>">
		            			<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/CK_Calvin_Klein_logo.svg/192px-CK_Calvin_Klein_logo.svg.png" alt=""><!-- "/assets/img/[articule|code].png" -->
		        			
			        			<h1><?php echo $value['brand']; ?></h1>
			        			<h2><?php echo $value['item']; ?></h2>
			        			<h2><?php echo $value['description']; ?></h2>
			        			<h1><?php echo $value['price']; ?> &#8381;</h1>
		        			</a>
		            	</div>
		            <?php endforeach ?>
	            </div>
			</div>
			<div class="col col-xs-12">
				<div class="pagination-div">
					<?php echo $pagination; ?>
				</div>
			</div>