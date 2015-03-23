<div class="page">
	<article>
		<p class="art-date"><?php echo $publication->date; ?></p>
		<h1><?php echo $publication->title; ?></h1>
		<?php echo $publication->description; ?>
		<?php if($publication->original == ''){ ?>
			<a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/files/<?php echo $publication->file; ?>"><?php echo $publication->file; ?></a>
		<?php }
		else{ ?>
			<a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/files/publications/<?php echo $publication->original0->file; ?>"><?php echo $publication->original0->file; ?></a>
		<?php } ?>
	</article>
</div>