<?php $languages = Languages::model()->findAllByAttributes(array('status'=>1)); ?>

<header class="principal-header">
	<h1 class="col-xs-6 principal-logo">
		<a href="<?php echo Yii::app()->homeUrl; ?>" class="super-div"></a>
	</h1>
	<div class="col-xs-6 align-right">
		<div class="multi-language">
			<p>
				<?php foreach ($languages as $key => $language) { ?>
					<a class="language-<?php echo MyMethods::normalizarUrl($language->name); ?>" href="<?php echo $this->createUrl('language/'.$language->id_language); ?>"><?php echo $language->name ?></a>
				<?php } ?>
			</p>
		</div>
		<div class="search">
			<form action="#">
				<input type="text" placeholder="Buscar...">
				<button><span class="fa fa-search"></span></button>
			</form>
		</div>
	</div>
</header>