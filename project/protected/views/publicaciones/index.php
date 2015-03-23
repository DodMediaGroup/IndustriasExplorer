<div class="page">
	<h1><?php echo $page->title; ?></h1>
	<?php foreach ($publications as $key => $publication) { ?>
		<article>
			<p class="art-date"><?php echo $publication->date; ?></p>
			<h1 class="art-title"><?php echo $publication->title; ?></h1>
			<p><?php echo substr(strip_tags($publication->description), 0, 310); ?>… <a href="<?php echo $this->createUrl($page->navigation.'/'.$publication->id_publication.'_'.MyMethods::normalizarUrl($publication->title)) ?>">Leer más</a></p>
		</article>
	<?php } ?>
</div>