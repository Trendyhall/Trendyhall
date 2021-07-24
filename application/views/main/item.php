<div class="row">
	<div class="col col-12 col-sm-7 mb-3">
		<!-- Carusel -->
	    <div id="itemCarousel" class="carousel carousel-dark slide" data-bs-ride="carousel" data-bs-interval="false">
	      
	      <div class="carousel-indicators">
	        <button type="button" data-bs-target="#itemCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
	        <?php if ($good['imagecount'] != 0): ?>
				<?php for ($i = 1; $i <= $good['imagecount']; $i++): ?>
	        		<button type="button" data-bs-target="#itemCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i+1; ?>"></button>
				<?php endfor; ?>
		    <?php endif; ?>
	      </div>

	      <div class="carousel-inner">
	        <div class="carousel-item active">
	        	<img src="<?php if ($good['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$good['id'].".webp"; }?>" class="d-block w-100" alt="...">
	        </div>
        	<?php if ($good['imagecount'] != 0): ?>
				<?php for ($i = 1; $i <= $good['imagecount']; $i++): ?>
	        	<div class="carousel-item">
				    <img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Alternate/id<?php echo $good['id']."_".$i; ?>.webp" class="d-block w-100" alt="...">
				</div>
				<?php endfor; ?>
		    <?php endif; ?>
	      </div>

	      <button class="carousel-control-prev" type="button" data-bs-target="#itemCarousel" data-bs-slide="prev">
	        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
	        <span class="visually-hidden">Previous</span>
	      </button>
	      <button class="carousel-control-next" type="button" data-bs-target="#itemCarousel" data-bs-slide="next">
	        <span class="carousel-control-next-icon" aria-hidden="true"></span>
	        <span class="visually-hidden">Next</span>
	      </button>
	    </div>
	    <!-- Carusel end -->

        <!-- Small images -->
        <div class="row row-cols-5" style="margin-left: -2px; margin-right: -2px; padding-top: 2px;">
        	<div class="col" style="padding: 2px;">
        		<button type="button" data-bs-target="#itemCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1" style="border: none; background-color: #fff; padding: 0;">
        			<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id<?php echo $good['id']; ?>.webp" class="w-100 scaleup-on-hover" alt="...">
        		</button>
        	</div>
        	<?php if ($good['imagecount'] != 0): ?>
	        	<?php for ($i = 1; $i <= $good['imagecount']; $i++): ?>
	        	<div class="col" style="padding: 2px;">
	        		<button type="button" data-bs-target="#itemCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i+1; ?>" style="border: none; background-color: #fff; padding: 0;">
				    	<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Alternate/id<?php echo $good['id']."_".$i; ?>.webp" class="w-100 scaleup-on-hover" alt="...">
					</button>
				</div>
				<?php endfor; ?>
	    	<?php endif; ?>
	    </div>
	    <!-- Small images end -->
	</div>
	<div class="col col-12 col-sm-5">
		<!-- first three line -->
        <h3><?php echo $good['name']; ?></h3>
		<div style="font-size: 1.2rem;"><?php echo $Othertables_model->GetByID("brands", "name", $good['brand']); ?></div>
		<?php if ($good['sale'] == 1): ?>
			<div style="font-size: 1.2rem;" class="mb-4 d-inline"><?php echo number_format($good['price'], 0,"."," "); ?> &#8381; </div>
		<?php endif; ?>
		<?php if ($good['sale'] != 1): ?>
			<?php $Sale = $Othertables_model->GetByID("sales", "sale", $good['sale']); ?>
			<div style="font-size: 1.2rem;" class="mb-4">
				<div style="text-decoration: line-through;" class="d-inline"><?php echo number_format($good['price'], 0,"."," "); ?> &#8381;</div>
				<div style="color: #f00;" class="d-inline"><?php echo number_format($good['price'] * (0.01 * (100 - $Sale)), 0,"."," "); ?> &#8381;</div>
			</div>
		<?php endif; ?>

	    <!-- size couse -->
	    <button id="sizeOffcanvasBtn" class="btn btn-outline-dark mb-3 w-100" type="button" data-bs-toggle="offcanvas" data-bs-target="#SizeOffcanvas" aria-controls="SizeOffcanvas" style="justify-content: space-between;display: flex;">
			Выбрать размер<span>&#10095;</span>
		</button>

		<div class="offcanvas offcanvas-end" tabindex="-1" id="SizeOffcanvas" aria-labelledby="SizeOffcanvasLabel">
		  <div class="offcanvas-header">
		    <h5 class="offcanvas-title" id="SizeOffcanvasLabel">Выбор размера</h5>
		    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
		  </div>
		  <div class="offcanvas-body">
		    <div>
		      Выбирите какого размера вещь вам нужна
		    </div>
		        <div class="list-group list-group-flush" id="sizeList" data-lt-target="-1">
		        	<?php foreach ($sizes as $key => $value): ?>
					    <button class="list-group-item list-group-item-actio d-flex justify-content-between align-items-center"<?php if ($value['count'] == 0) echo ' disabled';?> data-lt-id="<?php echo $value['id'] ?>">
					    	<?php echo $value['size'] ?>
					    	<span class="badge rounded-pill bg-<?php if ($value['count'] == 0) echo 'danger'; else echo 'dark'?>"><?php echo $value['count'] ?></span>
					    </button>
					<?php endforeach ?>
				</div >
		  </div>
		</div>

		<style>
			.fly-animation {
				position: fixed;
				z-index: 10;

				background-color: darkcyan;
				width: 16px;
				height: 16px;

				transition: top 2s ease, right 2s ease;
  				transition-timing-function: ease;

  				top: unset;
  				right: unset;
			}
		</style>


	    <!-- buttons -->
	    <div class="row m-0 mb-3">
	    	<div class="col col-10 position-relative" style="padding: 0 1px 0 0;">
	    		<span id="addToCartBadge" class="position-absolute top-0 start-50 translate-middle badge rounded-pill bg-dark" style="z-index: 1;">Выбирите размер</span>
	    		<button class="btn btn-outline-dark w-100" id="addToCart" disabled>В корзину</button>
	    		
	    	</div>
	    	<div class="col col-2" style="padding: 0 0 0 1px;">
	    		<button class="btn btn-outline-dark w-100" style="padding-left: 0; padding-right: 0;" id="addToLike" data-likeid="<?php echo $good['id']; ?>">
		    		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
	    				<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
					</svg>
				</button>
	    	</div>
	    	
	    </div>
	    

	    <!-- colour chouse -->
	    <h4>Другие цвета:</h4>
	    <div class="row row-cols-4 m-0 mb-3">
	    	<?php foreach ($colours as $key => $value): ?>
	    		<a href="/goods/<?php echo $value['modelcode'].'_'.$value['colour']; ?>" class="ps-1 pe-1">
	    			<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id<?php echo $value['id']; ?>.webp" class="w-100 scaleup-on-hover" alt="...">
	    		</a>
	    		
	    	<?php endforeach ?>
	    	
	    </div>

	    <!-- Discription -->



	    <!-- Discription for me -->
	    <?php if ($IsAdmin): ?>
		    <button class="btn btn-outline-dark w-100" type="button" data-bs-toggle="collapse" data-bs-target="#DATA" aria-expanded="false" aria-controls="DATA">
			    DATA
			</button>

			<div class="collapse" id="DATA" style="text-align: left;">
			    <?php foreach ($good as $key => $value): ?>
					<br>
					<?php echo $key.": ".$value; ?>
				<?php endforeach ?>
			</div>
		<?php endif; ?>
	</div>
</div>
	


