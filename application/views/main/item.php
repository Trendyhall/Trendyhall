
<div class="row">
	<div class="col col-12 col-sm-7">
        <img src="<?php if ($good['imagecount'] == 0) { echo "/assets/img/general/noimage.webp"; } else { echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id".$good['id'].".webp"; }?>" class="w-100" alt="...">

        <?php if ($good['imagecount'] != 0): ?>
	        <div class="row row-cols-5" style="margin-left: -2px; margin-right: -2px; padding-top: 2px;">
	        	<div class="col" style="padding: 2px;">
	        		<img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id<?php echo $good['id']; ?>.webp" class="w-100" alt="...">
	        	</div>
	        	<?php for ($i = 1; $i <= $good['imagecount']; $i++): ?>
	        	<div class="col" style="padding: 2px;">
				    <img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Alternate/id<?php echo $good['id']."_".$i; ?>.webp" class="w-100" alt="...">
				</div>
				<?php endfor; ?>
	        </div>
	    <?php endif; ?>
	</div>
	<div class="col col-12 col-sm-5">
	       
	        <div class="card-body">
		        <div class="card-brand"><?php echo $good['name']; ?></div>
        		<div class="card-name"><?php echo $good['brand']; ?></div>
        		<div class="card-price"><?php echo $good['price']; ?> &#8381;</div>
	        </div>
	</div>
</div>
	


<?php foreach ($good as $key => $value): ?>
	<br>
	<?php echo $key.": ".$value; ?>
<?php endforeach ?>