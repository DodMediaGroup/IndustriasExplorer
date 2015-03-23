<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'orders-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
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
					<h2><strong>Orden de Trabajo</strong></h2>
					<div class="additional-btn">
						<a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
					</div>
				</div>
				<div class="widget-content padding">
					<div class="form-group">
						<?php echo $form->labelEx($model,'number'); ?>
        				<?php echo $form->textField($model,'number',array('class'=>'form-control js-input-number','maxlength'=>6,'placeholder'=>'Numero de orden','required'=>true)); ?>
					</div>
					
					<div class="form-group">
						<?php echo $form->labelEx($model,'title'); ?>
						<?php echo $form->textField($model,'title',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Título de la orden','required'=>true)); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'description'); ?>
						<?php echo $form->textArea($model,'description',array('class'=>'form-control','maxlength'=>255,'placeholder'=>'Descripcion','rows'=>4)); ?>
					</div>

					<div class="form-group">
						<?php echo $form->labelEx($model,'order_status'); ?>
						<?php echo $form->dropDownList($model,'order_status', MyMethods::getListSelect('OrdersStatus', 'id_status', 'name'), array('class'=>'form-control')); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="form-group">
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-success')); ?>
                <a href="<?php echo $this->createUrl('clients/orders/'.$client->id_client); ?>" class="btn btn-danger">Cancelar</a>
			</div>
		</div>
	</div>
<?php $this->endWidget(); ?>