		<div class="row">
			<div class="col col-12 col-xs-12 col-sm-12 col-md-3 col-lg-3">
				<form action="" method="put" class="filters" name="filters">
					<div class="sort mb-3">
					  	<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSort" aria-expanded="false">
						    Сортировать<span class="arrow">&#10095;</span>
						</button>

						<div class="collapse" id="collapseSort">
						  <div class="list-group">
							  <label class="list-group-item">
							    <input name="sort-type" value="3" class="form-check-input me-1" type="radio" onclick="submitform();" checked>
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
						<div class="submitbtncont"><button class="submitbtn" type="submit">Применить</button></div>
						
						
						<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGroup" aria-expanded="false">
						    Тип<span class="arrow">&#10095;</span>
						</button>

						<div class="collapse" id="collapseGroup">
						    <div class="list-group">
							  	<?php foreach ($OtherTables_model->GetTable('groups') as $key => $value): ?>
									<label class="list-group-item">
									    <input name="itemgroup[]" class="form-check-input me-1" type="checkbox" value="<?php echo $value['name'] ?>">
									    <?php echo $value['name'] ?>
									</label>
								<?php endforeach ?>
							</div>
						</div>

						<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseColour" aria-expanded="false">
						    Цвет<span class="arrow">&#10095;</span>
						</button>

						<div class="collapse" id="collapseColour">
						    <div class="list-group">
							  	<?php foreach ($OtherTables_model->GetUniqueColumn('colours', 'runame') as $key => $value): ?>
									<label class="list-group-item">
									    <input name="colour[]" class="form-check-input me-1" type="checkbox" value="<?php echo $value['runame'] ?>">
									    <?php echo $value['runame'] ?>
									</label>
								<?php endforeach ?>
							</div>
						</div>

						<button class="sortbtn" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSize" aria-expanded="false">
						    Размер<span class="arrow">&#10095;</span>
						</button>

						<div class="collapse" id="collapseSize">
						    <div class="list-group">
							  	<?php foreach ($OtherTables_model->GetTable('sizes') as $key => $value): ?>
									<label class="list-group-item">
									    <input name="size[]" class="form-check-input me-1" type="checkbox" value="<?php echo $value['size'] ?>">
									    <?php echo $value['size'] ?>
									</label>
								<?php endforeach ?>
							</div>
							<?php 
							echo '<br>';
							echo print_r($where_array);

							?>
						</div>

						
					</div>
				</form>
				<script src="/assets/js/filters.js"></script>
			</div>