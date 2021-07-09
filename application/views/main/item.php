
<div class="row">
	<div class="col col-12 col-sm-7">
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
        			<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id<?php echo $good['id']; ?>.webp" class="w-100" alt="...">
        		</button>
        	</div>
        	<?php if ($good['imagecount'] != 0): ?>
	        	<?php for ($i = 1; $i <= $good['imagecount']; $i++): ?>
	        	<div class="col" style="padding: 2px;">
	        		<button type="button" data-bs-target="#itemCarousel" data-bs-slide-to="<?php echo $i; ?>" aria-label="Slide <?php echo $i+1; ?>" style="border: none; background-color: #fff; padding: 0;">
				    	<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Alternate/id<?php echo $good['id']."_".$i; ?>.webp" class="w-100" alt="...">
					</button>
				</div>
				<?php endfor; ?>
	    	<?php endif; ?>
	    </div>
	    <!-- Small images end -->
	</div>
	<div class="col col-12 col-sm-5">
	       
        <h2><?php echo $good['name']; ?></h2>
		<div class="card-name"><?php echo $good['brand']; ?></div>
		<div class="card-price"><?php echo $good['price']; ?> &#8381;</div>
	        
	</div>
</div>
	


<?php foreach ($good as $key => $value): ?>
	<br>
	<?php echo $key.": ".$value; ?>
<?php endforeach ?>