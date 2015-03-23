<div class="page">
	<article>
		<p class="art-date"><?php echo $new->date; ?></p>
		<h1><?php echo $new->title; ?></h1>
		<?php if($new->original != "" && $new->original0->image != ""){ ?>
			<a class="fancybox" rel="gallery_page" href="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->original0->image; ?>" title="">
				<img class="float-right" src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/300x300/<?php echo $new->original0->image; ?>" alt="Calidad Explorer">
			</a>
		<?php }
		else if($new->original == "" && $new->image != ""){ ?>
			<a class="fancybox" rel="gallery_page" href="<?php echo Yii::app()->request->baseUrl; ?>/images/news/<?php echo $new->image; ?>" title="">
				<img class="float-right" src="<?php echo Yii::app()->request->baseUrl; ?>/images/news/300x300/<?php echo $new->image; ?>" alt="Calidad Explorer">
			</a>
		<?php } ?>
		<?php echo $new->new; ?>
	</article>
</div>