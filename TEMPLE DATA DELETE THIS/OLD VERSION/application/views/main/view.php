			<div class="row no-margine">
				<div class="col col-md-4">
					<img src="<?php if ($good['hasimage'] == 0) { echo "/assets/img/noimage.png"; } else { echo "/assets/img/goods/".$good['code']."_".$good['colorcode']."_1.jpeg"; }?>" alt="">

					<div class="fluid-container">
						<div class="row no-margine mini-img-cont">
							<?php for ($i = 0;$i < $good['hasimage']; $i++): ?>
							<div class="col col-md-3 col-xs-3 col-lg-3 col-sm-3 mini-img <?php if ($i == 0) { echo "active"; } ?>">
								<img src="<?php echo "/assets/img/goods/".$good['code']."_".$good['colorcode']."_".($i+1).".jpeg"; ?>" alt="">
							</div>
							<?php endfor ?>
						</div>
					</div>
				</div>
				<div class="col col-md-8 col-lg-8 col-xs-8 col-sm-8">
					
					<?php foreach ($good as $key => $value): ?>
						<hr>
		            	<h5><?php echo $key; ?>: <?php echo $value; ?></h5>
		            <?php endforeach ?>
		            <hr>
				</div>
			</div>
			