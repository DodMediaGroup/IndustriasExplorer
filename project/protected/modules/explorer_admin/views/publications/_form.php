<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'publications-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
        'enctype'=>"multipart/form-data",
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
							$modelValues = Publications::model()->findByAttributes(array('original'=>$model->id_publication, 'language'=>$language->id_language));
							$modelValues = ($modelValues == null)?$model:$modelValues;
						}
						else
							$modelValues = $model;
					?>
						<section class="step" data-step-title="<?php echo $language->name; ?>">
							<div class="row">
								<input type="hidden" name="Publications[<?php echo $key ?>][language]" value="<?php echo $language->id_language; ?>">
								<div class="form-group">
									<label for="page-<?php echo $key ?>-title">Título</label>
									<input type="text" id="page-<?php echo $key ?>-title" name="Publications[<?php echo $key ?>][title]" class="form-control" value="<?php echo $modelValues->title; ?>">
								</div>
								<div class="form-group">
									<label for="page-<?php echo $key ?>-description">Descripción</label>
									<textarea name="Publications[<?php echo $key ?>][description]" id="page-<?php echo $key ?>-description" class="js-ckeditor"><?php echo $modelValues->description; ?></textarea>
								</div>
							</div>
						</section>
					<?php } ?>
					<section class="step" data-step-title="Extras">
						<div class="row">
							<div class="col-sm-6">
								<div class="from-group date js-my-datepicker">
									<?php
			                            date_default_timezone_set('America/Bogota');
			                            $date = (!$model->date == "")?(date_format(date_create($model->date), 'd/m/Y')):(date('d/m/Y'));
			                        ?>
									<?php echo $form->labelEx($model,'date'); ?>
			        				<?php echo $form->textField($model,'date',array('class'=>'form-control','placeholder'=>'Fecha','required'=>true,'readonly'=>true,'data-date-format'=>"DD/MM/YYYY",'value'=>$date)); ?>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<?php echo $form->labelEx($model,'file'); ?>
									<div class="group-inpu">
										<input type="file" class="btn btn-default" name="file" title="Search for a file to add" required>
										<span class="file-input-name"><?php echo $model->file; ?></span>
										<p class="help-block"><strong>Nota: </strong> Peso maximo 2Mb</p>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<a href="<?php echo $this->createUrl('publications/admin'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>