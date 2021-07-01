<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
	<?php foreach ($brands as $key => $value): ?>
		<div class="col brand-container">
			<a href="/brands/<?php echo $value['slug']; ?>">
			    <div class="card h-100">
			        <img src="<?php echo $value['logo']; ?>" class="card-img-top" alt="...">
			        <div class="card-body">
				        <h5 class="card-title"><?php echo $value['name']; ?></h5>
				        <!-- <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. </p> -->
			        </div>
			    </div>
			</a>
		</div>
	<?php endforeach ?>
</div>