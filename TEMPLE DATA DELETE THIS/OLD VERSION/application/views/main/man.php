			<?php 
				$url = parse_url($_SERVER['REQUEST_URI']);
				$query = "";
				parse_str(@$url['query'], $params);
				foreach ($params as $key => $value) {
					if ($key != 'sort') {
						$query .= "&".$key."=".$value;
					}
				}

				function is_Active($params, $key, $value)
				{
					if (strpos(@$params[$key], $value) !== false) {
						echo "active ";
					}
				}
			?>

			<div class="col col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<div class="sort">
				  	<button class="" type="button" data-toggle="collapse" data-target="#collapseSort" aria-expanded="false" aria-controls="collapseExample">Сортировать<span>&#10095;</span></button>
					<div class="collapse" id="collapseSort">
					    <a href="<?php echo $url['path']."?sort=0".$query; ?>"><div class="<?php if ($sort_type == 0) echo "active "; ?>radio-btn"><div></div><div>По умолчанию</div></div></a>
					    <a href="<?php echo $url['path']."?sort=1".$query; ?>"><div class="<?php if ($sort_type == 1) echo "active "; ?>radio-btn"><div></div><div>По возрастанию цены</div></div></a>
					    <a href="<?php echo $url['path']."?sort=2".$query; ?>"><div class="<?php if ($sort_type == 2) echo "active "; ?>radio-btn"><div></div><div>По убыванию цены</div></div></a>
					    <a href="<?php echo $url['path']."?sort=3".$query; ?>"><div class="<?php if ($sort_type == 3) echo "active "; ?>radio-btn"><div></div><div>Сначала новое</div></div></a>
					    <a href="<?php echo $url['path']."?sort=4".$query; ?>"><div class="<?php if ($sort_type == 4) echo "active "; ?>radio-btn"><div></div><div>Сначала старое</div></div></a>
					</div>
				</div>

				<div class="filters">
					<a href="<?php echo "/man/"; if (@$url['query'] != null) { echo "?".@$url['query']; }/*echo $_SERVER['REQUEST_URI'];*/ ?>" id="applyButtonHref" ><div class="apply-button">Применить</div></a>

					<button class="" type="button" data-toggle="collapse" data-target="#collapseGroup" aria-expanded="false" aria-controls="collapseExample">Тип<span>&#10095;</span></button>
					<div class="collapse" id="collapseGroup" data-group="group">
						<?php $key = 'group'; ?>
					    <div class="<?php is_Active($params, $key, 'Аксессуары') ?>toggle" data-group-item="Аксессуары"><div></div><div>Аксессуары</div></div>
					    <div class="<?php is_Active($params, $key, 'Одежда') ?>toggle" data-group-item="Одежда"><div></div><div>Одежда</div></div>
					    <div class="<?php is_Active($params, $key, 'Верхняя одежда') ?>toggle" data-group-item="Верхняя одежда"><div></div><div>Верхняя одежда</div></div>
					    
					    
					</div>

					<button class="" type="button" data-toggle="collapse" data-target="#collapseColor" aria-expanded="false" aria-controls="collapseExample">Цвет<span>&#10095;</span></button>
					<div class="collapse" id="collapseColor" data-group="color">
						<?php $key = 'color'; ?>
					    <div class="<?php is_Active($params, $key, 'black') ?>toggle" data-group-item="black"><div></div><div>чёрный</div></div>
					    <div class="<?php is_Active($params, $key, 'white') ?>toggle" data-group-item="white"><div></div><div>белый</div></div>
					    <div class="<?php is_Active($params, $key, 'blue') ?>toggle" data-group-item="blue"><div></div><div>синий</div></div>
					    <div class="<?php is_Active($params, $key, 'gray') ?>toggle" data-group-item="gray"><div></div><div>серый</div></div>
					    <div class="<?php is_Active($params, $key, 'green') ?>toggle" data-group-item="green"><div></div><div>зелёный</div></div>
					    <div class="<?php is_Active($params, $key, 'pink') ?>toggle" data-group-item="pink"><div></div><div>розовый</div></div>
					    <div class="<?php is_Active($params, $key, 'red') ?>toggle" data-group-item="red"><div></div><div>красный</div></div>
					    <div class="<?php is_Active($params, $key, 'silver') ?>toggle" data-group-item="silver"><div></div><div>серебряный</div></div>
					    <div class="<?php is_Active($params, $key, 'yellow') ?>toggle" data-group-item="yellow"><div></div><div>жёлтый</div></div>
					</div>

					<button class="" type="button" data-toggle="collapse" data-target="#collapseSize" aria-expanded="false" aria-controls="collapseExample">Размер<span>&#10095;</span></button>
					<div class="collapse" id="collapseSize" data-group="size">
						<?php $key = 'size'; ?>
					    <div class="<?php is_Active($params, $key, 'OS') ?>toggle" data-group-item="OS"><div></div><div>One Size</div></div>
					    <div class="<?php is_Active($params, $key, '8') ?>toggle" data-group-item="8"><div></div><div>8</div></div>
					    <div class="<?php is_Active($params, $key, '10') ?>toggle" data-group-item="10"><div></div><div>10</div></div>
					    <div class="<?php is_Active($params, $key, '12') ?>toggle" data-group-item="12"><div></div><div>12</div></div>
					    <div class="<?php is_Active($params, $key, '14') ?>toggle" data-group-item="14"><div></div><div>14</div></div>
					    <div class="<?php is_Active($params, $key, '16') ?>toggle" data-group-item="16"><div></div><div>16</div></div>
					    <div class="<?php is_Active($params, $key, 'S-M') ?>toggle" data-group-item="S-M"><div></div><div>S-M</div></div>
					    <div class="<?php is_Active($params, $key, 'L-XL') ?>toggle" data-group-item="L-XL"><div></div><div>L-XL</div></div>
					</div>
					
				</div>
				<script src="/assets/js/filters.js"></script>
			</div>


			<div class="col col-xs-12 col-sm-12 col-md-9 col-lg-9">
				<div class="row">
					<?php foreach ($goods as $key => $value): ?>
		            	<div class="col card col-xs-6 col-sm-4 col-md-4 col-lg-4">
		            		<a href="/goods/<?php echo $value['articule']; ?>">
		            			<img src="<?php if ($value['hasimage'] == 0) { echo "/assets/img/noimage.jpeg"; } else { echo "/assets/img/goods/".$value['code']."_".$value['colorcode']."_1.jpeg"; }?>" alt="">
		            			<!-- "/assets/img/[articule|code]_1.jpeg" -->
		        				
			        			<h1><?php echo $value['brand']; ?></h1>
			        			<h2><?php echo $value['item']; ?></h2>
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
            