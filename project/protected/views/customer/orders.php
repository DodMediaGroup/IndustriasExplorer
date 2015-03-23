<div class="page">
	<h1><?php echo Yii::app()->user->getState('_name') ?></h1>
	<?php foreach ($orders as $key => $order) { ?>
		<article style="margin-bottom: 30px;">
			<p class="art-date"><?php echo $order->orderStatus->name; ?></p>
			<h1 class="art-title"><?php echo $order->number.' - '.$order->title; ?></h1>
			<p><?php echo strip_tags($order->description); ?><br><a href="<?php echo $this->createUrl('customer/order/'.$order->id_order.'_'.MyMethods::normalizarUrl($order->title)) ?>">Ver informes</a></p>
		</article>
	<?php } ?>
</div>