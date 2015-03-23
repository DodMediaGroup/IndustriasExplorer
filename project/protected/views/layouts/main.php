<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

	<!-- Slide Principal -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/camera/camera.css">
	<!-- FancyBox -->
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fancybox/jquery.fancybox.css">

	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css">

	<link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/favicon.ico">
</head>
<body>
	<div class="container">
		<?php $this->renderPartial('/layouts/header'); ?>

		<?php $this->renderPartial('/layouts/menu'); ?>
		
		<?php echo $content; ?>

		<footer class="principal-footer">
			<p>Industrias Explorer © Todos los derechos reservados 2015</p>
		</footer>
	</div>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/js/jquery-1.11.1.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/bootstrap/bootstrap.min.js"></script>

	<!-- Slide Principal -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/js/jquery-migrate-1.2.1.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/camera/jquery.mobile.customized.min.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/camera/jquery.easing.1.3.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/camera/camera.min.js"></script>

	<!-- FancyBox -->
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/js/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?php echo Yii::app()->request->baseUrl; ?>/vendor/fancybox/jquery.fancybox.js"></script>

	<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/main.js"></script>

</body>
</html>