<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'raffles-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
    )
)); ?>

	<div class="row">
		<?php if($form->errorSummary($model) != ""){ ?>
			<div class="col-sm-12">
	            <div class="alert alert-danger">
	                <?php echo $form->errorSummary($model); ?>
	            </div>
	        </div>
        <?php } ?>
	</div>

	<div class="row">
		<div class="col-md-12">
			<!-- Your awesome content goes here -->
			<div class="widget animated fadeInDown">
				<div class="widget-header transparent">
					<h2><strong>Crear</strong> Página</h2>
				</div>
				<div class="js-myWizard">
					<?php foreach ($languages as $key => $language) {
						if($key == 0)
							$modelValues = $model;
						else if(!$model->isNewRecord){
							$modelValues = Pages::model()->findByAttributes(array('original'=>$model->id_page, 'language'=>$language->id_language));
							$modelValues = ($modelValues == null)?$model:$modelValues;
						}
						else
							$modelValues = $model;
					?>
						<section class="step" data-step-title="<?php echo $language->name; ?>">
							<div class="row">
								<input type="hidden" name="Page[<?php echo $key ?>][language]" value="<?php echo $language->id_language; ?>">
								<div class="form-group">
									<label for="page-<?php echo $key ?>-title">Título</label>
									<input type="text" id="page-<?php echo $key ?>-title" name="Page[<?php echo $key ?>][title]" class="form-control" value="<?php echo $modelValues->title; ?>">
								</div>
								<div class="form-group">
									<label for="page-<?php echo $key ?>-body">Cuerpo</label>
									<textarea name="Page[<?php echo $key ?>][body]" id="page-<?php echo $key ?>-body" class="js-ckeditor"><?php echo $modelValues->body; ?></textarea>
								</div>
							</div>
						</section>
					<?php } ?>
					<section class="step" data-step-title="Galeria">
						<div class="row">
							<?php foreach ($galleries as $key => $gallery) {
								$check= false;
								if(!$model->isNewRecord){
									$currentGalleries = PagesHasGalleries::model()->findByAttributes(array('page'=>$model->id_page, 'gallery'=>$gallery->id_gallery));
									if($currentGalleries != null)
										$check = true;
								}
							?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>
											<input type="radio" class="checkbox" name="Page[gallery]" value="<?php echo $gallery->id_gallery ?>" <?php echo ($check)?'checked':''; ?>>
											<?php echo $gallery->name; ?> (<?php echo count($gallery->images) ?> imagenes)
										</label>
										<div class="col-xs-12">
											<?php foreach ($gallery->images as $key => $image) {
												if($key < 3){ ?>
													<div class="my-image-gallery">
														<div style="background-image: url(<?php echo Yii::app()->request->baseUrl.'/images/galleries/'.$gallery->id_gallery.'/100x100/'.$image->path ?>)"></div>
													</div>
												<?php }
											} ?>
										</div>
									</div>
								</div>
							<?php } ?>
						</div>
					</section>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<a href="<?php echo $this->createUrl('pages/admin'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	

<?php $this->endWidget(); ?>