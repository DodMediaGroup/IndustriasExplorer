<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'news-form',
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
							$modelValues = News::model()->findByAttributes(array('original'=>$model->id_new, 'language'=>$language->id_language));
							$modelValues = ($modelValues == null)?$model:$modelValues;
						}
						else
							$modelValues = $model;
					?>
						<section class="step" data-step-title="<?php echo $language->name; ?>">
							<div class="row">
								<input type="hidden" name="News[<?php echo $key ?>][language]" value="<?php echo $language->id_language; ?>">
								<div class="form-group">
									<label for="page-<?php echo $key ?>-title">Título</label>
									<input type="text" id="page-<?php echo $key ?>-title" name="News[<?php echo $key ?>][title]" class="form-control" value="<?php echo $modelValues->title; ?>">
								</div>
								<div class="form-group">
									<label for="page-<?php echo $key ?>-new">Noticia</label>
									<textarea name="News[<?php echo $key ?>][new]" id="page-<?php echo $key ?>-body" class="js-ckeditor"><?php echo $modelValues->new; ?></textarea>
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
									<div class="imag-before-upload" style="background-image: url(<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png); max-width: 270px;">
										<?php if(!$model->isNewRecord && $model->image != ""){ ?>
											<div class="img" style="background-image: url(<?php echo Yii::app()->request->baseUrl; ?>/images/news/300x300/<?php echo $model->image; ?>)"></div>
										<?php } ?>
									</div>
									<input type="file" accept="image/*" class="btn btn-default js-show-before" name="image" data-before=".imag-before-upload" title="<?php echo ($model->isNewRecord)?'Agregar Imagen':'Cambiar Imagen' ?>">
									<p class="help-block"><strong>Nota: </strong> Dimensiones recomendadas de 650x380. Peso maximo 512Kb.</p>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="col-sm-12">
					<div class="form-group">
						<a href="<?php echo $this->createUrl('news/admin'); ?>" class="btn btn-danger">Cancelar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>