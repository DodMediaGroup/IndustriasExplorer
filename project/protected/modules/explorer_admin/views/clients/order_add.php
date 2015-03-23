<div class="page-heading">
    <h1>Agregar orden de trabajo - <small><?php echo $client->name; ?></small></h1>
</div>

<?php $this->renderPartial('_form_order', array(
										'model'=>$model,
										'client'=>$client
									)); ?>