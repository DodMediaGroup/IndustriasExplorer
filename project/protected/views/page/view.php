<?php
	$template = explode(':', strip_tags($page->body));
	if($template[0] == 'template')
		$this->renderPartial(trim($template[1]));
	else{ ?>
		<div class="page">
			<article>
				<?php if(count($page->galleries) > 0 || ($page->original != "" && count($page->original0->galleries) > 0)){
					$gallery = ($page->original == "")?$page->galleries[0]:$page->original0->galleries[0];
				?>
					<div class="gallery">
						<?php foreach ($gallery->images as $key => $image) { ?>
							<a class="fancybox" rel="gallery_page" href="<?php echo Yii::app()->request->baseUrl; ?>/images/galleries/<?php echo $gallery->id_gallery; ?>/<?php echo $image->path; ?>" title="">
								<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/galleries/<?php echo $gallery->id_gallery; ?>/250x250/<?php echo $image->path; ?>" alt="" />
							</a>
						<?php } ?>
					</div>
				<?php } ?>
				
				<?php echo $page->body; ?>
			</article>
		</div>
	<?php }
?>