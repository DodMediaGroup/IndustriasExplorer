<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'orders-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
        'enctype'=>"multipart/form-data",
    )
));
?>
	<div class="row">
		<?php if($form->errorSummary($model) != ""){ ?>
			<div class="col-sm-12">
	            <div class="alert alert-danger">
	                <?php echo $form->errorSummary($model); ?>
	            </div>
	        </div>
        <?php } ?>
		<div class="col-sm-12">
			<div class="widget">
				<div class="widget-header transparent">
					<h2><strong>Informe</strong></h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					<div class="from-group date js-my-datepicker">
						<?php
	                        date_default_timezone_set('America/Bogota');
	                        $date = (!$model->date == "")?(date_format(date_create($model->date), 'd/m/Y')):(date('d/m/Y'));
	                    ?>
						<?php echo $form->labelEx($model,'date'); ?>
	    				<?php echo $form->textField($model,'date',array('class'=>'form-control','placeholder'=>'Fecha','required'=>true,'readonly'=>true,'data-date-format'=>"DD/MM/YYYY",'value'=>$date)); ?>
					</div>

					<div class="form-group" style="margin-top: 15px;">
						<?php echo $form->labelEx($model,'file'); ?>
						<div class="group-inpu">
							<input type="file" class="btn btn-default" name="file" title="Search for a file to add">
							<p class="help-block"><strong>Nota: </strong> Peso maximo 2Mb</p>
						</div>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'comments'); ?>
						<?php echo $form->textArea($model,'comments',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Comentarios','rows'=>4)); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-success')); ?>
                <a href="<?php echo $this->createUrl('clients/reports/'.$order->id_order); ?>" class="btn btn-danger">Informes</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>