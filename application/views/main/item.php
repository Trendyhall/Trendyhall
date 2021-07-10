<script src="/assets/js/cart.js"></script>
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
		<!-- first three line -->
        <h2><?php echo $good['name']; ?></h2>
		<div style="font-size: 1.4rem;"><?php echo $Othertables_model->GetByID("brands", "name", $good['brand']); ?></div>
		<?php if ($good['sale'] == 1): ?>
			<div style="font-size: 1.4rem;"><?php echo number_format($good['price'], 2,"."," "); ?> &#8381; </div>
		<?php endif; ?>
		<?php if ($good['sale'] != 1): ?>
			<?php $Sale = $Othertables_model->GetByID("sales", "sale", $good['sale']); ?>
			<div style="font-size: 1.4rem;">
				<div style="text-decoration: line-through; display: inline;"><?php echo number_format($good['price'], 2,"."," "); ?> &#8381;</div>
				<div style="color: #f00; display: inline;"><?php echo number_format($good['price'] * (0.01 * (100 - $Sale)), 2,"."," "); ?> &#8381;</div>
			</div>
		<?php endif; ?>
	    <!-- size couse -->

	    <!-- buttons -->
	    <div class="mb-3">
	    	<button class="btn btn-outline-dark" id="addToCart" style="border-radius: 0;" onclick="addToCart(<?php echo $good['id']; ?>)">Добавить</button>
	    	<button class="btn btn-outline-dark" id="addToLike" style="border-radius: 0;">
	    		<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
    				<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
				</svg>
			</button>
	    </div>
	    

	    <!-- colour couse -->

	    <!-- Discription -->
	    <button class="btn btn-outline-dark" type="button" data-bs-toggle="collapse" data-bs-target="#DATA" aria-expanded="false" aria-controls="DATA" style="border-radius: 0;">
		    DATA
		</button>

		<div class="collapse" id="DATA" style="text-align: left;">
		    <?php foreach ($good as $key => $value): ?>
				<br>
				<?php echo $key.": ".$value; ?>
			<?php endforeach ?>
		</div>

	</div>
</div>
	


