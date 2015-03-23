<div class="page-heading">
    <h1>Editar informe - <small><?php echo $order->title; ?> - <?php echo $order->client0->name; ?></small></h1>
</div>

<?php $this->renderPartial('_form_report', array(
										'model'=>$model,
										'order'=>$order
									)); ?>