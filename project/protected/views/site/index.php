<?php $language = Yii::app()->request->cookies['language']->value; ?>

<div class="principal-slide">
	<div class="camera_wrap">
		<?php foreach ($slide->images as $key => $image) { ?>
			<div data-src="<?php echo Yii::app()->request->baseUrl; ?>/images/galleries/<?php echo $slide->id_gallery ?>/<?php echo $image->path; ?>"></div>
		<?php } ?>
    </div>
</div>

<div class="row cells">
	<?php
		$module = Pages::model()->findByPk(3);
		if($module->language == $language)
			$module = $module->navigation;
		else{
			$module = Pages::model()->findByAttributes(array('original'=>$module->id_page, 'language'=>$language));
			$module = $module->navigation;
		}

		foreach ($news as $key => $new) { ?>
		<div class="col-sm-4 col-xs-6 cell">
			<article class="padding-cell">
				<h1><?php echo $new->title ?></h1>
				<?php if($new->original != "" && $new->original0->image != ""){ ?>
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/100x100/<?php echo $new->original0->image; ?>" alt="Calidad Explorer">
				<?php }
				else if($new->original == "" && $new->image != ""){ ?>
					<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/100x100/<?php echo $new->image; ?>" alt="">
				<?php } ?>
				<p>
					<?php echo substr(strip_tags($new->new), 0, 200); ?>... <a href="<?php echo $this->createUrl($module.'/'.$new->id_new.'_'.MyMethods::normalizarUrl($new->title)) ?>">Leer más</a>
				</p>
			</article>
		</div>
	<?php } ?>
	<div class="col-sm-4 col-xs-12 cell">
		<div class="padding-cell">
			<?php if(!Yii::app()->user->isGuest && Yii::app()->user->getState('_type') == 'client'){ ?>
				<?php $client = Clients::model()->findByPk(Yii::app()->user->getState('_client')); ?>
				<h2><?php echo Yii::app()->user->getState('_name'); ?></h2>
				<div class="image-circle" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/images/clients/<?php echo $client->image ?>)"></div>
				<div class="link">
					<a href="<?php echo $this->createUrl('customer/orders'); ?>">Ordenes de Trabajo</a>
				</div>
				<div class="form-group">
					<a href="<?php echo $this->createUrl('customer/logout'); ?>" class="btn btn-default">Salir</a>
				</div>
			<?php }
			else{ ?>
				<h2>Tráfico</h2>
				<form action="<?php echo $this->createUrl('customer/login'); ?>" class="form-horizontal js-form-customer">
					<div class="form-group">
						<label for="login-user" class="col-sm-4 control-label">Usuario</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="username" id="login-user" placeholder="Usuario" required>
						</div>
					</div>
					<div class="form-group">
						<label for="login-pass" class="col-sm-4 control-label">Contraseña</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="password" id="login-pass" placeholder="Contraseña" required>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-4 col-sm-8">
							<button type="submit" class="btn btn-default">Ingresar</button>
						</div>
					</div>
				</form>
			<?php } ?>
		</div>
	</div>
</div>

<div class="sgs">
	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/sgs.png" alt="SGS">
	<div class="super-div"></div>
</div>