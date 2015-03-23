<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'clients-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
        'enctype'=>"multipart/form-data",
    )
));
	$model->password = "";
?>
	<div class="row">
		<?php if($form->errorSummary($model) != ""){ ?>
			<div class="col-sm-12">
	            <div class="alert alert-danger">
	                <?php echo $form->errorSummary($model); ?>
	            </div>
	        </div>
        <?php } ?>
		<div class="col-sm-6">
			<div class="widget">
				<div class="widget-header transparent">
					<h2><strong>Usuario</strong></h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					<div class="form-group">
						<?php echo $form->labelEx($model,'name'); ?>
        				<?php echo $form->textField($model,'name',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Nombre','required'=>true)); ?>
					</div>
					
					<hr>
					<strong>Establecer datos de acceso</strong>
					
					<div class="form-group">
						<?php echo $form->labelEx($model,'user'); ?>
						<?php echo $form->textField($model,'user',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Usuario','required'=>true)); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'password'); ?>
						<?php echo $form->passwordField($model,'password',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Contraseña')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="widget">
				<div class="widget-header transparent">
					<h2><strong>Imagen</strong> (Opcional)</h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					<div class="form-group">
						<div class="imag-before-upload" style="background-image: url(<?php echo Yii::app()->request->baseUrl; ?>/images/clients/default.jpg); max-width: 270px;">
							<?php if(!$model->isNewRecord && $model->image != ""){ ?>
								<div class="img" style="background-image: url(<?php echo Yii::app()->request->baseUrl; ?>/images/clients/<?php echo $model->image; ?>)"></div>
							<?php } ?>
						</div>
						<input type="file" accept="image/*" class="btn btn-default js-show-before" name="image" data-before=".imag-before-upload" title="<?php echo ($model->isNewRecord)?'Agregar Imagen':'Cambiar Imagen' ?>">
						<p class="help-block"><strong>Nota: </strong> Dimensiones recomendadas de 300x300. Peso maximo 512Kb.</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-success')); ?>
                <a href="<?php echo $this->createUrl('clients/admin'); ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>