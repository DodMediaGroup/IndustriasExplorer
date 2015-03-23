<div class="page-heading">
    <h1>Crear menu para idioma <?php echo $language->name; ?></h1>
</div>

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'menus-form',
    'enableAjaxValidation'=>false,
    'htmlOptions'=>array(
        'role'=>'form',
    )
)); ?>

<div class="row">
	<div class="col-md-12">
		<div class="widget" style="display:none">
			<textarea id="nestable-output" name="menu_order" class="form-control"></textarea>
		</div>
		<div class="widget">
			<div class="widget-header">
				<h2>Ubique los items segun desee</h2>
			</div>
			<div class="widget-content padding">
				<div class="row">
					<div class="col-sm-6">
						<h4>Menu</h4>
						<div class="dd nestable nestable_out" data-group="1">
							<ol class="dd-empty">
								
							</ol>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<h4>Páginas sin asignar</h4>
								<div class="dd nestable nestable_in" data-group="group_1">
									<ol class="dd-list">
										<?php foreach ($pages as $key => $page) { ?>
											<li class="dd-item" data-id="<?php echo $page->id_page ?>">
												<div class="dd-handle"><?php echo $page->title ?></div>
											</li>
										<?php } ?>
									</ol>
								</div>
							</div>
						</div>
						<div class="row" style="margin-top:30px; border-top: 1px dashed #666;">
							<div class="col-sm-12">
								<h5>Agregar Página</h5>
								<div class="form-group">
									<label for="add_item_menu">Nombre</label>
									<div class="input-group">
										<input type="text" id="add_item_menu" class="form-control">
										<span class="input-group-btn">
											<button class="btn btn-default js-add-item-list" type="button">Agregar!</button>
									  	</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top:15px;">
					<div class="col-sm-12">
						<div class="form-group">
							<?php echo CHtml::submitButton($model->isNewRecord ? 'Crear' : 'Guardar', array('class'=>'btn btn-success')); ?>
			                <a href="<?php echo $this->createUrl('menus/admin'); ?>" class="btn btn-danger">Cancelar</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php $this->endWidget(); ?>