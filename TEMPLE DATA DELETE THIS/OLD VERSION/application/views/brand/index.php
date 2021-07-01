			<?php foreach ($brands as $key => $value): ?>
            	<div class="col card col-xs-6 col-sm-4 col-md-3 col-lg-3">
            		<a href="/brands/<?php echo $value['slug']; ?>">
            			<img src="<?php echo $value['logo']; ?>" alt="">
        			
        				<h1><?php echo $value['name']; ?></h1>
        			</a>
            	</div>
            <?php endforeach ?>