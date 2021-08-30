		
			<div class="col col-12 col-md-3">
				
				
				<form action="" method="put" class="filters" name="filters">
					<div class="sort mb-2 black-border">
					  	<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSort" aria-expanded="false">
						    Сортировать<span class="arrow">&#10095;</span>
						</button>

						<div class="collapse" id="collapseSort">
						  <div class="list-group">
							  <label class="list-group-item">
							    <input name="sort-type" value="0" class="form-check-input me-1" type="radio" onclick="submitform();" checked>
							    По умолчанию
							  </label>
							  <label class="list-group-item">
							    <input name="sort-type" value="1" class="form-check-input me-1" type="radio" onclick="submitform();">
							    По возрастанию цены
							  </label>
							  <label class="list-group-item">
							    <input name="sort-type" value="2" class="form-check-input me-1" type="radio" onclick="submitform();">
							    По убыванию цены
							  </label>
							  <label class="list-group-item">
							    <input name="sort-type" value="3" class="form-check-input me-1" type="radio" onclick="submitform();">
							    Сначала новое
							  </label>
							  <label class="list-group-item">
							    <input name="sort-type" value="4" class="form-check-input me-1" type="radio" onclick="submitform();">
							    Сначала старое
							  </label>
							</div>
						</div>
					</div>
					

					<div class="filters mb-3">
						
						<?php foreach ($sorting as $key => $value): ?>
							<div class="black-border mb-2">
								<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $key; ?>" aria-expanded="false">
								    <?php echo $value[1]; ?><span class="arrow">&#10095;</span>
								</button>

								<div class="collapse" id="collapse<?php echo $key; ?>">
								    <div class="list-group">
									  	<?php foreach ($value[0] as $key1 => $value1): ?>
											<label class="list-group-item">
											    <input name="<?php echo $key; ?>[]" class="form-check-input me-1" type="checkbox" value="<?php echo $value1['id']; ?>">
											    <?php echo $value1['name']; ?>
											</label>
										<?php endforeach ?>
									</div>
								</div>
							</div>
						<?php endforeach ?>	

						
						<button class="submitbtn btn btn-outline-dark" type="submit">Применить</button>
					</div>
				</form>
				<script src="/assets/js/filters.js"></script>
			</div>
			